<?php

namespace App\Http\Controllers;

use App\Models\PackageGallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = PackageGallery::whereHas('package')
            ->latest()
            ->paginate(12);

        return view('gallery.index', compact('galleries'));
    }
}
