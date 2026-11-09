<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $heroSlide = HeroSlide::first();

        $sections = [
            [
                'name' => 'Hero / Slideshow',
                'key' => 'slide',
            ],
            [
                'name' => 'Category',
                'key' => 'category',
            ],
            [
                'name' => 'Statistics',
                'key' => 'statistics',
            ],
            [
                'name' => 'Get to Know Us',
                'key' => 'about',
            ],
            [
                'name' => 'Testimonials',
                'key' => 'testimonials',
            ],
            [
                'name' => 'Gallery',
                'key' => 'gallery',
            ],
            [
                'name' => 'FAQ',
                'key' => 'faq',
            ],
        ];

        return view('admin.page.index', compact('sections', 'heroSlide'));
    }
}
