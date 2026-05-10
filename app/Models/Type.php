<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_id',
        'name_en',
        'description_id',
        'description_en',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke package
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
