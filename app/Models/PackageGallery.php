<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'image_url',
    ];

    // Relasi ke package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
