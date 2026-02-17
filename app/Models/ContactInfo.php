<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function types()
    {
        return [
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'office_name' => 'Office Name',
            'map_embed' => 'Map',
            'social_media' => 'Social Media',
        ];
    }
}
