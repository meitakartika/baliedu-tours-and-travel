<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;
use App\Models\PackageReview;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tab = request('tab', 'profile');

        $bookings = collect();
        $pendingReviews = collect();
        $myReviews = collect();

        // LOAD BOOKINGS hanya kalau buka tab booking
        if ($tab === 'booking') {

            $bookings = Booking::with('package')
                ->where('user_id', $user->id)
                ->latest()
                ->get()
                ->map(function ($booking) {
                    $booking->tour_date_formatted =
                        \Carbon\Carbon::parse($booking->tour_date)
                        ->format('d M Y');

                    return $booking;
                });
        }

        // LOAD TESTIMONIAL hanya kalau tab testimonial
        if ($tab === 'testimonial') {

            $pendingReviews = Booking::with('package')
                ->where('user_id', $user->id)
                ->where('status', 'completed')
                ->whereDoesntHave('review')
                ->latest()
                ->get();

            $myReviews = PackageReview::with(['booking.package'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        // BADGE COUNT
        $pendingCount = Booking::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->count();

        return view('account.index', compact(
            'user',
            'bookings',
            'pendingReviews',
            'myReviews',
            'pendingCount'
        ))->with('countries', config('countries'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validateWithBag('profile', [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'phone'         => ['required', 'regex:/^\+?[0-9]{8,15}$/'],
            'date_of_birth' => 'nullable|date',
            'country'       => 'nullable|string|max:100',
        ]);

        $user->update($validated);

        return back()->with('success_profile', 'Profile updated successfully');
    }

    public function updateSecurity(Request $request)
    {
        $request->validateWithBag('security', [
            'email'    => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8',
        ]);

        $user = Auth::user();
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success_security', 'Security updated successfully');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        // hapus gambar lama
        if (
            $user->profile_image &&
            Storage::disk('public')->exists($user->profile_image)
        ) {

            Storage::disk('public')->delete($user->profile_image);
        }

        // simpan baru
        $path = $request->file('profile_image')
            ->store('profile_images', 'public');

        $user->update([
            'profile_image' => $path
        ]);

        return back()->with('success', 'Profile image updated!');
    }
}
