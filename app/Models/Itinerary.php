<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'day',
        'time',
        'title_id',
        'title_en',
    ];

    // Relasi ke Package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Relasi ke detail itinerary
    public function details()
    {
        return $this->hasMany(ItineraryDetail::class);
    }
}
