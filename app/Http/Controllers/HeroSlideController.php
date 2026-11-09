<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $heroSlide = HeroSlide::first();

        return view('admin.page.slide.index', compact('heroSlide'));
    }

    // Menyimpan perubahan deskripsi dan gambar
    public function update(Request $request)
    {
        $request->validate([
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpg,jpeg,png|max:5120',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'string',
        ]);

        // Ambil data hero atau buat baru
        $heroSlide = HeroSlide::first();

        if (!$heroSlide) {
            $heroSlide = new HeroSlide();
            $heroSlide->images = [];
        }

        // Update deskripsi
        $heroSlide->description_id = $request->description_id;
        $heroSlide->description_en = $request->description_en;

        // Ambil gambar yang sudah tersimpan
        $images = $heroSlide->images ?? [];

        // Hapus gambar yang dipilih
        $removeImages = $request->input('remove_images', []);

        foreach ($removeImages as $image) {
            if (in_array($image, $images)) {
                Storage::disk('public')->delete($image);

                $images = array_diff($images, [$image]);
            }
        }

        // Upload gambar baru
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $images[] = $image->store('hero-slides', 'public');
            }
        }

        // Simpan data
        $heroSlide->images = array_values($images);
        $heroSlide->save();

        return redirect()
            ->route('page.slide.index')
            ->with('success', 'Hero Slide berhasil diperbarui.');
    }
}
