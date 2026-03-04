<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Category;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\PackageList;
use App\Models\PackageReview;
use App\Models\Type;

class AdminSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!$search) {
            return redirect()->back();
        }

        // ================= BOOKING =================
        $bookings = Booking::with(['user', 'package'])
            ->where(function ($q) use ($search) {
                $q->whereHas('user', function ($user) use ($search) {
                    $user->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('package', function ($package) use ($search) {
                        $package->where('name_id', 'like', "%{$search}%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    });
            })
            ->get();

        // ================= CATEGORY =================
        $categories = Category::where(function ($q) use ($search) {
            $q->where('name_id', 'like', "%{$search}%")
                ->orWhere('name_en', 'like', "%{$search}%")
                ->orWhere('description_id', 'like', "%{$search}%")
                ->orWhere('description_en', 'like', "%{$search}%");
        })->get();

        // ================= CONTACT INFO =================
        $contactInfos = ContactInfo::where(function ($q) use ($search) {
            $q->where('type', 'like', "%{$search}%")
                ->orWhere('label', 'like', "%{$search}%")
                ->orWhere('value_en', 'like', "%{$search}%")
                ->orWhere('value_id', 'like', "%{$search}%");
        })->get();

        // ================= CONTACT MESSAGE =================
        $contactMessages = ContactMessage::with('user')
            ->where(function ($q) use ($search) {
                $q->whereHas('user', function ($user) use ($search) {
                    $user->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhere('created_at', 'like', "%{$search}%");
            })
            ->get();

        // ================= CUSTOMER =================
        $customers = User::where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->get();

        // ================= ITINERARY =================
        $itineraries = Package::withCount('itineraries')
            ->whereHas('itineraries')
            ->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_id', 'like', "%{$search}%");
            })
            ->get();

        // ================= PACKAGE =================
        $packages = Package::with(['category', 'type'])
            ->where(function ($q) use ($search) {
                $q->where('name_id', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($cat) use ($search) {
                        $cat->where('name_id', 'like', "%{$search}%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    })
                    ->orWhereHas('type', function ($type) use ($search) {
                        $type->where('name_id', 'like', "%{$search}%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    });
            })
            ->get();

        // ================= LIST =================
        $lists = Package::withCount([
            'packageLists as includes_count' =>
            fn($q) => $q->where('type', 'includes'),

            'packageLists as not_includes_count' =>
            fn($q) => $q->where('type', 'not_includes'),

            'packageLists as must_bring_count' =>
            fn($q) => $q->where('type', 'must_bring'),
        ])
            ->whereHas('packageLists') // hanya yg punya list
            ->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_id', 'like', "%{$search}%");
            })
            ->get();

        // ================= TESTIMONIAL =================
        $testimonials = PackageReview::with(['user', 'package'])
            ->where(function ($q) use ($search) {
                $q->whereHas('user', function ($user) use ($search) {
                    $user->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('package', function ($package) use ($search) {
                        $package->where('name_id', 'like', "%{$search}%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    });
            })
            ->get();

        // ================= TYPE =================
        $types = Type::with('category')
            ->where(function ($q) use ($search) {
                $q->where('name_id', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('description_id', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($cat) use ($search) {
                        $cat->where('name_id', 'like', "%{$search}%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    });
            })
            ->get();

        return view('admin.search.index', compact(
            'search',
            'bookings',
            'categories',
            'contactInfos',
            'contactMessages',
            'customers',
            'itineraries',
            'packages',
            'lists',
            'testimonials',
            'types'
        ));
    }
}
