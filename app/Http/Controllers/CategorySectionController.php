<?php

namespace App\Http\Controllers;

use App\Models\CategorySection;
use Illuminate\Http\Request;

class CategorySectionController extends Controller
{
    public function index()
    {
        $categorySection = CategorySection::first();

        return view('admin.page.category.index', compact('categorySection'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'label_id' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $categorySection = CategorySection::first();

        if (!$categorySection) {
            $categorySection = new CategorySection();
        }

        $categorySection->fill($validated);
        $categorySection->save();

        return redirect()
            ->route('page.category.index')
            ->with('success', 'Category section berhasil diperbarui.');
    }
}