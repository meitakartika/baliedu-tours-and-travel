<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contacts_info';
    
    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'type',   // phone, email, address, map_embed, office_name
        'label',
        'value_id',      // isi konten bahasa Indonesia
        'value_en',      // isi konten bahasa Inggris
    ];

    // Helper untuk filter per type
    public static function officeNames()
    {
        return self::where('type', 'office_name')->get();
    }

    public static function phones()
    {
        return self::where('type', 'phone')->get();
    }

    public static function emails()
    {
        return self::where('type', 'email')->get();
    }

    public static function socialMedia()
    {
        return self::where('type', 'social_media')->get();
    }

    public static function addresses()
    {
        return self::where('type', 'address')->get();
    }

    public static function maps()
    {
        return self::where('type', 'map_embed')->get();
    }

    /**
     * Ambil value sesuai locale
     */
    public function getValue($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        // Kalau type address atau office_name, pakai multi-bahasa
        if (in_array($this->type, ['address', 'office_name'])) {
            return $this->{'value_' . $locale} ?? $this->value_id;
        }

        // Untuk type lain, fallback ke value_id
        return $this->value_id;
    }
}
