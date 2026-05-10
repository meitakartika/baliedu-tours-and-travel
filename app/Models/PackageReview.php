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
        'booking_id',
        'rating',
        'comment',
        'images',
        'agreement',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // Relasi ke package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
