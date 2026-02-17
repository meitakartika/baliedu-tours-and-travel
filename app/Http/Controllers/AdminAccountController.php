<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $countries = config('countries');

        return view('admin.account.index', compact('admin', 'countries'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'phone'         => ['required', 'regex:/^\+?[0-9]{8,15}$/'],
            'date_of_birth' => 'nullable|date',
            'country'       => 'nullable|string|max:100',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin->update($validated);

        return back()->with('success_profile', 'Profile updated successfully');
    }

    public function updateSecurity(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8',
        ]);

        $admin->email = $validated['email'];
        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return back()->with('success_security', 'Security updated successfully');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $admin = Auth::user();

        // hapus lama
        if (
            $admin->profile_image &&
            Storage::disk('public')->exists($admin->profile_image)
        ) {

            Storage::disk('public')->delete($admin->profile_image);
        }

        // simpan baru
        $path = $request->file('profile_image')
            ->store('profile_images', 'public');

        $admin->update([
            'profile_image' => $path
        ]);

        return back()->with('success_profile', 'Profile image updated!');
    }
}
