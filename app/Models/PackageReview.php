<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'rating',
        'comment',
        'image_url',
        'agreement',
    ];

    /**
     * Relasi ke paket
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
