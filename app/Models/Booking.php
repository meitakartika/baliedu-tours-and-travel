<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'tour_date',
        'guest_count',
        'payment_proof',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }
}
