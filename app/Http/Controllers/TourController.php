<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Package;

class TourController extends Controller
{

    public function category(Request $request, Category $category)
{
    $types = $category->types()
        ->orderBy('name_en')
        ->get();

    // 🔑 Tentukan kolom search berdasarkan locale
    $searchColumn = app()->getLocale() === 'id' ? 'name_id' : 'name_en';

    $packages = Package::with(['type', 'galleries'])
        ->withAvg('reviews', 'rating')
        ->withCount('reviews')

        // kategori
        ->whereHas('type', function ($q) use ($category) {
            $q->where('category_id', $category->id);
        })

        // 🔍 AUTO SEARCH BY LOCALE
        ->when($request->filled('search'), function ($q) use ($request, $searchColumn) {
            $q->where($searchColumn, 'like', '%' . $request->search . '%');
        })

        // 🎯 FILTER TYPE
        ->when($request->filled('type'), fn ($q) =>
            $q->where('type_id', $request->type)
        )

        // 🔃 SORT
        ->when($request->sort === 'highest', fn ($q) =>
            $q->orderByDesc('reviews_avg_rating')
        )
        ->when($request->sort === 'lowest', fn ($q) =>
            $q->orderBy('reviews_avg_rating')
        )
        ->when(
            ! $request->filled('sort') || $request->sort === 'newest',
            fn ($q) => $q->latest()
        )

        ->paginate(9)
        ->withQueryString();

    return view('tours.index', compact('category', 'packages', 'types'));
}

public function show(Package $package, Request $request)
{
    // Load relasi yang dibutuhkan
    $package->load(['type', 'galleries', 'reviews.user', 'itineraries.details', 'includes', 'notIncludes', 'mustBring']);

    // Mulai query review
    $reviewsQuery = $package->reviews()->with('user');

    // Filter berdasarkan query
    if ($request->filled('filter')) {
        if ($request->filter === 'photo') {
            $reviewsQuery->whereNotNull('images')
                ->where('images', '!=', '[]'); // hanya yang ada foto
        } elseif (is_numeric($request->filter)) {
            $reviewsQuery->where('rating', $request->filter); // filter by rating
        }
    }

    // Ambil semua review yang sudah difilter
    $reviews = $reviewsQuery->latest()->paginate(3)->withQueryString();
    if ($request->ajax()) {
    return response()->json([
        'reviews' => $reviews->items(),
        'next_page' => $reviews->nextPageUrl()
    ]);
}

    // Hitung rata-rata rating
    $package->rating_avg = round($package->reviews->avg('rating'), 1);

    // Hitung jumlah review per rating untuk summary bar
    $ratingCounts = $package->reviews()
        ->selectRaw('rating, count(*) as total')
        ->groupBy('rating')
        ->pluck('total', 'rating')
        ->toArray();

    return view('tours.show', compact('package', 'reviews', 'ratingCounts'));
}

public function search(Request $request)
{
    $query = Package::query();

    // LOCATION → name / overview
    if ($request->filled('location')) {
        $location = $request->location;

        $query->where(function ($q) use ($location) {
            $q->where('name_id', 'like', "%$location%")
              ->orWhere('name_en', 'like', "%$location%")
              ->orWhere('overview_id', 'like', "%$location%")
              ->orWhere('overview_en', 'like', "%$location%");
        });
    }

    // DURATION
    if ($request->filled('duration')) {
        $query->where('duration', $request->duration);
    }

    // GUESTS (diantara min & max)
    if ($request->filled('guests')) {
        $guests = $request->guests;

        $query->where('guest_min', '<=', $guests)
              ->where('guest_max', '>=', $guests);
    }

    $packages = $query->latest()->paginate(9);

    return view('search.index', compact('packages'));
}

}
