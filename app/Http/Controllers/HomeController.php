<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackageGallery;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $galleries = PackageGallery::latest()
            ->take(8)
            ->get();

        return view('home.index', compact('categories', 'galleries'));
    }
}
