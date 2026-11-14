<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StatisticsSection;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $statisticsSection = StatisticsSection::firstOrCreate(
            [],
            [
                'label_id' => 'STATISTIK KAMI',
                'title_id' => 'Pencapaian Kami',
                'description_id' => 'Kenali pengalaman dan pencapaian kami.',

                'label_en' => 'OUR STATISTICS',
                'title_en' => 'Our Achievements',
                'description_en' => 'Discover our experience and achievements.',

                'number_1' => '10+',
                'text_1_id' => 'Tahun Pengalaman',
                'text_1_en' => 'Years Experience',

                'number_2' => '50+',
                'text_2_id' => 'Paket Wisata',
                'text_2_en' => 'Amazing Tours',

                'number_3' => '1000+',
                'text_3_id' => 'Pelanggan Puas',
                'text_3_en' => 'Happy Customers',
            ]
        );

        return view('admin.page.statistics.index', compact('statisticsSection'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'label_id' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',

            'number_1' => 'required|string|max:50',
            'text_1_id' => 'required|string|max:255',
            'text_1_en' => 'required|string|max:255',

            'number_2' => 'required|string|max:50',
            'text_2_id' => 'required|string|max:255',
            'text_2_en' => 'required|string|max:255',

            'number_3' => 'required|string|max:50',
            'text_3_id' => 'required|string|max:255',
            'text_3_en' => 'required|string|max:255',
        ]);

        $statisticsSection = StatisticsSection::first();

        $statisticsSection->update($request->only([
            'label_id',
            'label_en',
            'title_id',
            'title_en',
            'description_id',
            'description_en',

            'number_1',
            'text_1_id',
            'text_1_en',

            'number_2',
            'text_2_id',
            'text_2_en',

            'number_3',
            'text_3_id',
            'text_3_en',
        ]));

        return redirect()->route('page.statistics.index')
            ->with('success', 'Statistics content updated successfully.');
    }
}