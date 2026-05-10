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
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        // daftar kolom yang boleh di sort
        $allowedSorts = [
            'name',
            'package',
            'rating',
            'date'
        ];
        // daftar direction
        $allowedDirections = ['asc', 'desc'];

        // cek apakah sort ada di daftar yang diizinkan
        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        // cek direction valid atau tidak
        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        $packageNameColumn = app()->getLocale() == 'id'
            ? 'packages.name_id'
            : 'packages.name_en';

        $query = PackageReview::with(['user', 'package'])
            ->leftJoin('users', 'package_reviews.user_id', '=', 'users.id')
            ->leftJoin('packages', 'package_reviews.package_id', '=', 'packages.id')
            ->select('package_reviews.*');

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('packages.name_id', 'like', "%{$search}%")
                    ->orWhere('packages.name_en', 'like', "%{$search}%");
            });
        }

        // FILTER RATING
        if ($ratings) {
            $query->whereIn('package_reviews.rating', $ratings);
        }

        // SORTING
        if ($sort === 'name') {
            $query->orderBy('users.first_name', $direction);
        } elseif ($sort === 'package') {
            $query->orderBy($packageNameColumn, $direction);
        } elseif ($sort === 'rating') {
            $query->orderBy('package_reviews.rating', $direction);
        } elseif ($sort === 'date') {
            $query->orderBy('package_reviews.created_at', $direction);
        } else {
            $query->latest('package_reviews.created_at');
        }

        $testimonials = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.testimonials.index', compact(
            'testimonials',
            'sort',
            'direction'
        ));
    }

    public function edit(PackageReview $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, PackageReview $testimonial)
    {
        $images = json_decode($request->images, true) ?? []; // Ambil images dari request, mengubah JSON menjadi array PHP

        // Hapus file yang dihapus admin
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
