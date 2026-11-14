<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\ContactInfo;

class AppServiceProvider extends ServiceProvider // menjalankan konfigurasi atau logic global aplikasi Laravel
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void //  // mengirim data ke semua Blade view
    {
        view()->share('categories', Category::orderBy('position', 'asc')
            ->orderBy('id', 'asc')
            ->get()
);

        $adminPhone = ContactInfo::where('type', 'phone')->first();
        $adminEmail = ContactInfo::where('type', 'email')->first();
        $baliOffice = ContactInfo::where('type', 'address')->where('label', 'Footer')->first();
        view()->share([
            'adminPhone' => $adminPhone,
            'adminEmail' => $adminEmail,
            'baliOffice' => $baliOffice,
        ]);

        $socialMedias = ContactInfo::where('type', 'social_media')->get();
        view()->share('socialMedias', $socialMedias);
    }
}
