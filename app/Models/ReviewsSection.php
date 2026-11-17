<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewsSection extends Model
{
    protected $fillable = [
        'label_id',
        'label_en',
        'title_1_id',
        'title_1_en',
        'rating_number',
        'reviews_text_id',
        'reviews_text_en',
        'travelers_number',
        'travelers_text_id',
        'travelers_text_en',

        'card_title_1_id',
        'card_title_1_en',
        'card_description_1_id',
        'card_description_1_en',
        'reviewer_name_1',
        'reviewer_country_1_id',
        'reviewer_country_1_en',
        'reviewer_image_1',

        'card_title_2_id',
        'card_title_2_en',
        'card_description_2_id',
        'card_description_2_en',
        'reviewer_name_2',
        'reviewer_country_2_id',
        'reviewer_country_2_en',
        'reviewer_image_2',

        'card_title_3_id',
        'card_title_3_en',
        'card_description_3_id',
        'card_description_3_en',
        'reviewer_name_3',
        'reviewer_country_3_id',
        'reviewer_country_3_en',
        'reviewer_image_3',
    ];
}
