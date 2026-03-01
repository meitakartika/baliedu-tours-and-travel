<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\ContactInfo;

class AppServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        view()->share('categories', Category::all());

        $adminPhone = ContactInfo::where('type', 'phone')->first();
        $adminEmail = ContactInfo::where('type', 'email')->first();
        $baliOffice = ContactInfo::where('type', 'address')->where('label', 'Bali Office')->first();
        view()->share([
            'adminPhone' => $adminPhone,
            'adminEmail' => $adminEmail,
            'baliOffice' => $baliOffice,
        ]);

        $socialMedias = ContactInfo::where('type', 'social_media')->get();
        view()->share('socialMedias', $socialMedias);
    }
}
