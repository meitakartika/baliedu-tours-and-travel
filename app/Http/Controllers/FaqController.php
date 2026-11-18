<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqSection;

class FaqController extends Controller
{
    public function index()
    {
        $faqSection = FaqSection::firstOrCreate([]);

        return view('admin.page.home.faq.index', compact('faqSection'));
    }

    public function update(Request $request)
    {
        $rules = [
            'label_id' => 'nullable|string|max:255',
            'label_en' => 'nullable|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
        ];

        for ($i = 1; $i <= 6; $i++) {
            $rules["question_{$i}_id"] = 'nullable|string|max:255';
            $rules["question_{$i}_en"] = 'nullable|string|max:255';
            $rules["answer_{$i}_id"] = 'nullable|string';
            $rules["answer_{$i}_en"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $faqSection = FaqSection::firstOrCreate([]);
        $faqSection->update($validated);

        return redirect()
            ->route('page.faq.index')
            ->with('success', 'FAQ section berhasil diperbarui.');
    }
}
