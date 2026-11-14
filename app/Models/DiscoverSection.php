<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscoverSection extends Model
{
    protected $fillable = [
        // Indonesian
        'label_id',
        'title_id',
        'description_id',
        'button_id',

        // English
        'label_en',
        'title_en',
        'description_en',
        'button_en',

        // Images
        'image_1',
        'image_2',
        'image_3',
    ];
}
