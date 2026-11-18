<?php

namespace App\Http\Controllers;

use App\Models\ContactHero;
use App\Models\ContactHeading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
    // ================= HERO =================

    public function hero()
    {
        $contactHero = ContactHero::first();

        return view('admin.page.contact.hero.index', compact('contactHero'));
    }

    public function updateHero(Request $request)
    {
        $validated = $request->validate([
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'remove_image' => 'nullable|boolean',

            'title_id_1' => 'nullable|string|max:255',
            'title_id_2' => 'nullable|string|max:255',
            'title_en_1' => 'nullable|string|max:255',
            'title_en_2' => 'nullable|string|max:255',
        ]);

        $contactHero = ContactHero::firstOrNew();

        // UPLOAD IMAGE
        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($contactHero->image) {
                Storage::disk('public')->delete($contactHero->image);
            }

            $validated['image'] = $request->file('image')
                ->store('contact-hero', 'public');

        } elseif ($request->boolean('remove_image')) {

            // HAPUS IMAGE
            if ($contactHero->image) {
                Storage::disk('public')->delete($contactHero->image);
            }

            $validated['image'] = null;
        }

        unset($validated['remove_image']);

        $contactHero->fill($validated);
        $contactHero->save();

        return redirect()->route('page.contact.hero.index')
            ->with('success', 'Contact Hero berhasil diupdate.');
    }


    // ================= HEADING =================

    public function heading()
    {
        $contactHeading = ContactHeading::first();

        return view('admin.page.contact.heading.index', compact('contactHeading'));
    }

    public function updateHeading(Request $request)
    {
        $validated = $request->validate([
            'label_id'       => 'nullable|string|max:255',
            'label_en'       => 'nullable|string|max:255',
            'title_id'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $contactHeading = ContactHeading::firstOrNew();
        $contactHeading->fill($validated);
        $contactHeading->save();

        return redirect()->route('page.contact.heading.index')
            ->with('success', 'Contact Heading berhasil diupdate.');
    }
}
