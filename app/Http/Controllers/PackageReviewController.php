<?php

namespace App\Http\Controllers;

use App\Models\PackageReview;
use Illuminate\Http\Request;

class PackageReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $ratings = $request->rating;

        $testimonials = PackageReview::with(['user', 'package'])

            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('package', function ($q) use ($search) {
                        $q->where('name_id', 'like', "%$search%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    });
            })
            ->when($ratings, function ($query) use ($ratings) {
                $query->whereIn('rating', $ratings);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function edit(PackageReview $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, PackageReview $testimonial)
    {
        $images = json_decode($request->images, true) ?? [];

        // Hapus file yang dihapus dari storage
        $oldImages = $testimonial->images ?? [];
        $removedImages = array_diff($oldImages, $images);
        foreach ($removedImages as $img) {
            if (file_exists(storage_path('app/public/' . $img))) {
                unlink(storage_path('app/public/' . $img));
            }
        }

        // Update kolom images
        $testimonial->images = $images;
        $testimonial->save();

        return redirect()->route('testimonials.admin.index')
            ->with('success', 'Testimonial berhasil diupdate.');
    }

    public function destroy(PackageReview $testimonial)
    {
        if ($testimonial->images) {
            foreach ($testimonial->images as $img) {
                if (file_exists(storage_path('app/public/' . $img))) {
                    unlink(storage_path('app/public/' . $img));
                }
            }
        }
        $testimonial->delete();

        return redirect()
            ->route('testimonials.admin.index')
            ->with('success', 'Testimonial berhasil dihapus.');
    }
}
