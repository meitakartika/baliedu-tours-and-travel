<?php

namespace App\Http\Controllers;

use App\Models\DiscoverSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiscoverController extends Controller
{
    public function index()
    {
        $discoverSection = DiscoverSection::firstOrCreate([], [
            'label_id' => 'Temukan Bali',
            'title_id' => 'Jelajahi Keindahan dan Pengalaman Wisata Bali',
            'description_id' => 'Temukan berbagai pengalaman wisata menarik di Bali bersama kami.',
            'button_id' => 'Selengkapnya',

            'label_en' => 'Discover Bali',
            'title_en' => 'Explore the Beauty and Travel Experiences of Bali',
            'description_en' => 'Discover exciting travel experiences in Bali with us.',
            'button_en' => 'Learn More',
        ]);

        return view('admin.page.discover.index', compact('discoverSection'));
    }

    
public function update(Request $request)
{
    $request->validate([
        'label_id' => 'required|string|max:255',
        'title_id' => 'required|string|max:255',
        'description_id' => 'required|string',
        'button_id' => 'required|string|max:255',

        'label_en' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'description_en' => 'required|string',
        'button_en' => 'required|string|max:255',

        'images' => 'nullable|array|max:3',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',

        'remove_images' => 'nullable|array',
        'remove_images.*' => 'distinct|in:image_1,image_2,image_3',
    ]);

    $discoverSection = DiscoverSection::firstOrFail();

    // Data teks
    $data = $request->only([
        'label_id',
        'title_id',
        'description_id',
        'button_id',
        'label_en',
        'title_en',
        'description_en',
        'button_en',
    ]);

    // Gambar yang akan dihapus
    $removeImages = $request->input('remove_images', []);

    // Gambar baru yang diunggah
    $newImages = $request->file('images', []);

    // Hitung gambar lama yang tetap dipertahankan
    $remainingImages = collect(['image_1', 'image_2', 'image_3'])
        ->filter(function ($field) use ($discoverSection, $removeImages) {
            return $discoverSection->$field && !in_array($field, $removeImages);
        })
        ->count();

    // Pastikan total gambar tidak lebih dari 3
    if ($remainingImages + count($newImages) > 3) {
        return back()
            ->withErrors(['images' => 'Maximum 3 images allowed.'])
            ->withInput();
    }

    // Hapus gambar lama yang dipilih
    foreach ($removeImages as $field) {
        if ($discoverSection->$field) {
            Storage::disk('public')->delete($discoverSection->$field);
            $data[$field] = null;
        }
    }

    // Cari slot gambar yang tersedia
    $availableSlots = [];

    foreach (['image_1', 'image_2', 'image_3'] as $field) {
        if (empty($discoverSection->$field) || in_array($field, $removeImages)) {
            $availableSlots[] = $field;
        }
    }

    // Simpan gambar baru ke slot yang tersedia
    foreach ($newImages as $index => $file) {
        if (isset($availableSlots[$index])) {
            $field = $availableSlots[$index];
            $data[$field] = $file->store('discover', 'public');
        }
    }

    // Simpan seluruh perubahan
    $discoverSection->update($data);

    return redirect()
        ->route('page.discover.index')
        ->with('success', 'Discover section berhasil diperbarui.');
}
}
