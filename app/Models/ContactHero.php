<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactHero extends Model
{
    protected $fillable = [
        'image',
        'title_id_1',
        'title_id_2',
        'title_en_1',
        'title_en_2',
    ];
}
