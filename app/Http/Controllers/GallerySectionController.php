<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GallerySection;

class GallerySectionController extends Controller
{
    public function index()
    {
        $gallerySection = GallerySection::firstOrCreate([]);

        return view('admin.page.gallery.index', compact('gallerySection'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'label_id' => 'nullable|string|max:255',
            'label_en' => 'nullable|string|max:255',

            'title_id' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',

            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',

            'button_id' => 'nullable|string|max:255',
            'button_en' => 'nullable|string|max:255',
        ]);

        $gallerySection = GallerySection::firstOrCreate([]);

        $gallerySection->update($request->only([
            'label_id',
            'label_en',
            'title_id',
            'title_en',
            'description_id',
            'description_en',
            'button_id',
            'button_en',
        ]));

        return redirect()
            ->route('page.gallery.index')
            ->with('success', 'Gallery section berhasil diperbarui.');
    }
}
