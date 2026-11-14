<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'image',
        'position',
    ];

    // Relasi ke tipe
    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
