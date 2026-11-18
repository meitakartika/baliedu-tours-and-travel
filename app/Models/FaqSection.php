<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqSection extends Model
{
    protected $fillable = [
        'label_id',
        'label_en',
        'title_id',
        'title_en',

        'question_1_id',
        'question_1_en',
        'answer_1_id',
        'answer_1_en',

        'question_2_id',
        'question_2_en',
        'answer_2_id',
        'answer_2_en',

        'question_3_id',
        'question_3_en',
        'answer_3_id',
        'answer_3_en',

        'question_4_id',
        'question_4_en',
        'answer_4_id',
        'answer_4_en',

        'question_5_id',
        'question_5_en',
        'answer_5_id',
        'answer_5_en',

        'question_6_id',
        'question_6_en',
        'answer_6_id',
        'answer_6_en',
    ];
}
