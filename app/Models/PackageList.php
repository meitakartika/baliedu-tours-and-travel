<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageList extends Model
{
    use HasFactory;

    protected $table = 'package_lists';

    protected $fillable = [
        'package_id',
        'type',        // must_bring | includes | not_includes
        'content_id',
        'content_en',
    ];

    /**
     * Relasi ke Package
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Helper biar rapi dipanggil
     */
    public function getMustBring($query)
    {
        return $query->where('type', 'must_bring');
    }

    public function getIncludes($query)
    {
        return $query->where('type', 'includes');
    }

    public function getNotIncludes($query)
    {
        return $query->where('type', 'not_includes');
    }
    public function getContentAttribute()
    {
        return app()->getLocale() === 'en'
            ? $this->content_en
            : $this->content_id;
    }
}
