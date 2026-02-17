<?php

namespace App\Http\Controllers;

use App\Models\PackageReview;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::orderBy('name_en')->get();

        $reviews = PackageReview::with([
            'package:id,name_en,name_id,type_id',
            'package.type',
            'user:id,first_name,last_name,profile_image'
        ])

            ->when($request->filled('type'), function ($q) use ($request) {
                $q->whereHas('package', function ($q2) use ($request) {
                    $q2->where('type_id', $request->type);
                });
            })

            // SORT
            ->when(
                $request->sort === 'highest',
                fn($q) =>
                $q->orderByDesc('rating')
            )

            ->when(
                $request->sort === 'lowest',
                fn($q) =>
                $q->orderBy('rating')
            )

            ->when(
                $request->sort === 'oldest',
                fn($q) =>
                $q->oldest()
            )

            ->when(
                ! $request->filled('sort') || $request->sort === 'newest',
                fn($q) => $q->latest()
            )

            ->paginate(9)
            ->withQueryString();


        // ⭐ summary langsung DB
        $averageRating = PackageReview::avg('rating');
        $totalReviews = PackageReview::count();

        return view('testimonials.index', compact(
            'reviews',
            'types',
            'averageRating',
            'totalReviews'
        ));
    }

    public function create(Booking $booking)
    {
        // SECURITY CHECK
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // hanya boleh review kalau completed
        if ($booking->status !== 'completed') {
            abort(403);
        }

        // cegah double review
        $already = PackageReview::where('booking_id', $booking->id)->exists();

        if ($already) {
            return redirect()->route('testimonials')
                ->with('error', 'You already reviewed this package.');
        }

        $booking->load('package');
        $user = Auth::user();
        $countries = config('countries');

        return view('testimonials.create', compact('booking', 'user', 'countries'));
    }

    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'agreement' => 'accepted',
        ]);

        $imagePaths = [];
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $imagePaths[] = $file->store('review_images', 'public');
    }
}

        PackageReview::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'package_id' => $booking->package_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'images' => $imagePaths,
            'agreement' => $request->has('agreement') ? 1 : 0,
        ]);

        return redirect()->route('testimonials')
            ->with('success', 'Thank you for your review!');
    }

    public function destroy(PackageReview $review)
{
    // SECURITY — pastikan cuma pemilik review yang bisa hapus
    if ($review->user_id !== Auth::id()) {
        abort(403);
    }

    // Hapus gambar jika ada
    if (!empty($review->images)) {
        foreach ($review->images as $img) {
            Storage::disk('public')->delete($img);
        }
    }

    // Delete review
    $review->delete();

    return back()->with('success', 'Testimonial deleted successfully.');
}

}
