<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackageGallery;
use App\Models\HeroSlide;
use App\Models\CategorySection;
use App\Models\StatisticsSection;
use App\Models\DiscoverSection;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('position', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        $galleries = PackageGallery::latest()
            ->take(8)
            ->get();
        $heroSlides = HeroSlide::first();
        $categorySection = CategorySection::first();
        $statisticsSection = StatisticsSection::first();
        $discoverSection = DiscoverSection::first();

        return view('home.index', compact('categories', 'galleries', 'heroSlides', 'categorySection', 'statisticsSection', 'discoverSection'));
    }
}
