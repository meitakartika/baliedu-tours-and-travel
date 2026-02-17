<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // Mass assignable
    protected $fillable = [
        'category_id',
        'type_id',
        'name_id',
        'name_en',
        'overview_id',
        'overview_en',
        'duration',
        'guest_min',
        'guest_max',
        'price',
        'image_url',
    ];

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke tipe
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Relasi ke itineraries
     */
    public function itineraries()
    {
        return $this->hasMany(Itinerary::class);
    }

    /**
     * Relasi ke galeri paket
     */
    public function galleries()
    {
        return $this->hasMany(PackageGallery::class);
    }

    /**
     * Relasi ke review
     */
    public function reviews()
    {
        return $this->hasMany(PackageReview::class);
    }

    /**
     * Relasi ke booking
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function packageLists()
{
    return $this->hasMany(PackageList::class);
}

public function includes()
{
    return $this->hasMany(PackageList::class)
        ->where('type', 'includes');
}

public function notIncludes()
{
    return $this->hasMany(PackageList::class)
        ->where('type', 'not_includes');
}

public function mustBring()
{
    return $this->hasMany(PackageList::class)
        ->where('type', 'must_bring');
}

}
