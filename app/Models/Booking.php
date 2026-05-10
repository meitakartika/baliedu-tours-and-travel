<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'tour_date',
        'guest_count',
        'total_price',
        'payment_proof',
        'status',
    ];

    protected $casts = [
        'tour_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function review()
    {
        return $this->hasOne(PackageReview::class);
    }

    // auto status completed
    protected static function booted()
    {
        static::retrieved(function ($booking) {

            // skip kalau bukan confirmed
            if ($booking->status !== 'confirmed') {
                return;
            }

            // skip kalau tour_date masih future
            if ($booking->tour_date >= today()) {
                return;
            }

            $booking->loadMissing('package');

            $endDate = Carbon::parse($booking->tour_date)
                ->addDays($booking->package->duration - 1);

            if ($endDate->lt(today())) {
                $booking->updateQuietly([
                    'status' => 'completed',
                ]);
            }
        });
    }
}
