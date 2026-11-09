<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackageGallery;
use App\Models\HeroSlide;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $galleries = PackageGallery::latest()
            ->take(8)
            ->get();
        $heroSlides = HeroSlide::first();

        return view('home.index', compact('categories', 'galleries', 'heroSlides'));
    }
}
