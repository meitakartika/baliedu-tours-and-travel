<?php

namespace App\Http\Controllers;

use App\Models\ReviewsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewsController extends Controller
{
     public function index()
    {
        $reviewsSection = ReviewsSection::firstOrCreate([]);

        return view('admin.page.reviews.index', compact('reviewsSection'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // LEFT CONTENT
            'label_id' => 'nullable|string|max:255',
            'label_en' => 'nullable|string|max:255',

            'title_1_id' => 'nullable|string|max:255',
            'title_1_en' => 'nullable|string|max:255',

            'rating_number' => 'required|numeric|min:0|max:5',
            'reviews_text_id' => 'nullable|string|max:255',
            'reviews_text_en' => 'nullable|string|max:255',

            'travelers_number' => 'required|integer|min:0',
            'travelers_text_id' => 'nullable|string|max:255',
            'travelers_text_en' => 'nullable|string|max:255',

            // TESTIMONIAL CARDS
            'card_title_1_id' => 'nullable|string|max:255',
            'card_title_1_en' => 'nullable|string|max:255',
            'card_description_1_id' => 'nullable|string',
            'card_description_1_en' => 'nullable|string',
            'reviewer_name_1' => 'nullable|string|max:255',
            'reviewer_country_1_id' => 'nullable|string|max:255',
            'reviewer_country_1_en' => 'nullable|string|max:255',
            'reviewer_image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            'card_title_2_id' => 'nullable|string|max:255',
            'card_title_2_en' => 'nullable|string|max:255',
            'card_description_2_id' => 'nullable|string',
            'card_description_2_en' => 'nullable|string',
            'reviewer_name_2' => 'nullable|string|max:255',
            'reviewer_country_2_id' => 'nullable|string|max:255',
            'reviewer_country_2_en' => 'nullable|string|max:255',
            'reviewer_image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            'card_title_3_id' => 'nullable|string|max:255',
            'card_title_3_en' => 'nullable|string|max:255',
            'card_description_3_id' => 'nullable|string',
            'card_description_3_en' => 'nullable|string',
            'reviewer_name_3' => 'nullable|string|max:255',
            'reviewer_country_3_id' => 'nullable|string|max:255',
            'reviewer_country_3_en' => 'nullable|string|max:255',
            'reviewer_image_3' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            'remove_image_1' => 'nullable|boolean',
            'remove_image_2' => 'nullable|boolean',
            'remove_image_3' => 'nullable|boolean',
        ]);

        $reviewsSection = ReviewsSection::firstOrCreate([]);

        // Simpan seluruh teks
        $reviewsSection->fill($request->except([
            '_token',
            '_method',
            'reviewer_image_1',
            'reviewer_image_2',
            'reviewer_image_3',
            'remove_image_1',
            'remove_image_2',
            'remove_image_3',
        ]));

        // Kelola foto ketiga kartu
        for ($i = 1; $i <= 3; $i++) {
            $imageField = "reviewer_image_$i";
            $removeField = "remove_image_$i";

            // Hapus foto lama jika diminta
            if ($request->boolean($removeField)) {
                if ($reviewsSection->$imageField) {
                    Storage::disk('public')->delete($reviewsSection->$imageField);
                }

                $reviewsSection->$imageField = null;
            }

            // Upload foto baru jika ada
            if ($request->hasFile($imageField)) {
                if ($reviewsSection->$imageField) {
                    Storage::disk('public')->delete($reviewsSection->$imageField);
                }

                $reviewsSection->$imageField = $request->file($imageField)
                    ->store('reviews', 'public');
            }
        }

        $reviewsSection->save();

        return redirect()
            ->route('page.reviews.index')
            ->with('success', 'Testimonials berhasil diperbarui.');
    }
}
