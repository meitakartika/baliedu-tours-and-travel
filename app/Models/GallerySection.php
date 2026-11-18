<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySection extends Model
{
    protected $fillable = [
        'label_id',
        'label_en',
        'title_id',
        'title_en',
        'description_id',
        'description_en',
        'button_id',
        'button_en',
    ];
}
