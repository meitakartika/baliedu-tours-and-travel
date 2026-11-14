<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticsSection extends Model
{
    protected $fillable = [
        'label_id',
        'title_id',
        'description_id',

        'label_en',
        'title_en',
        'description_en',

        'number_1',
        'text_1_id',
        'text_1_en',

        'number_2',
        'text_2_id',
        'text_2_en',

        'number_3',
        'text_3_id',
        'text_3_en',
    ];
}
