<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageReviewController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\ContactMessagesController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\PackageListController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialsController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/tours/category/{category}', [TourController::class, 'category'])->name('tours.category');
Route::get('/tours/{package}', [TourController::class, 'show'])->name('tours.show');

Route::get('/about', function () {return view('about.index');})->name('about');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/search-tours', [TourController::class, 'search'])->name('search');

Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials');
Route::middleware('auth')->group(function(){
    Route::get('/add-testimonial/{booking}', [TestimonialsController::class,'create'])->name('testimonials.create');
    Route::post('/add-testimonial/{booking}', [TestimonialsController::class,'store'])->name('testimonials.store');
    Route::delete('/testimonials/{review}', [TestimonialsController::class, 'destroy'])->name('testimonials.destroy');
});

Route::get('/contact', [ContactInfoController::class, 'contact'])->name('contact');
Route::post('/contact-messages', [ContactMessagesController::class, 'store'])->middleware('auth')->name('contact.messages.store');

Route::middleware('auth')->group(function () {
    Route::get('/my-account', [AccountController::class, 'index'])->name('account');
    Route::put('/my-account/profile', [AccountController::class, 'updateProfile'])->name('account.profile');
    Route::put('/my-account/security', [AccountController::class, 'updateSecurity'])->name('account.security');
    Route::post('/account/profile-image',[AccountController::class,'updateProfileImage'])->name('account.profile.image');
});

Route::middleware('auth')->group(function () {
    Route::post('/booking', [BookingController::class, 'booking'])->name('booking.submit');
    Route::get('/booking/step1', [BookingController::class, 'step1'])->name('booking.step1');
    Route::post('/booking/step1', [BookingController::class, 'storeStep1'])->name('booking.storeStep1');
    Route::get('/booking/step2', [BookingController::class, 'step2'])->name('booking.step2');
    Route::get('/booking/step3', [BookingController::class, 'step3'])->name('booking.step3');
    Route::post('/booking/submit', [BookingController::class, 'storeBooking'])->name('booking.store');
    Route::get('/booking-success', function () {return view('booking.success');})->name('booking.success');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('customers', CustomerController::class)->except(['show']);
        Route::resource('contact-info', ContactInfoController::class)->names('contact.info')->except(['show']);
        Route::resource('contact-messages', ContactMessagesController::class)->names('contact.messages')->only(['index', 'show', 'store', 'destroy']);
        Route::post('/contact-messages/{contactMessage}/reply', [ContactMessagesController::class, 'reply'])->name('contact.messages.reply');
        Route::resource('package-category', CategoryController::class)->parameters(['package-category' => 'category'])->names('package.category')->except(['show']);
        Route::resource('package-type', TypeController::class)->parameters(['package-type' => 'type'])->names('package.type')->except(['show']);
        Route::get('types-by-category/{category}', [TypeController::class, 'getByCategory'])->name('types.by.category');
        Route::resource('package-itinerary', ItineraryController::class)->names('package.itinerary')->except(['show']);
        Route::resource('package-list', PackageListController::class)->names('package.list')->except(['show']);
        Route::resource('package-tour', PackageController::class)->parameters(['package-tour' => 'package'])->names('package.tour')->except(['show']);
        Route::resource('bookings', BookingController::class)->names('bookings')->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('testimonials', PackageReviewController::class)->names('testimonials.admin')->except(['show']);
        Route::get('account', [AdminAccountController::class,'index'])->name('admin.account.index');
        Route::put('account/profile', [AdminAccountController::class,'updateProfile'])->name('admin.account.updateProfile');
        Route::put('account/security', [AdminAccountController::class,'updateSecurity'])->name('admin.account.updateSecurity');
        Route::post('profile-image', [AdminAccountController::class,'updateProfileImage'])->name('admin.account.profile.image');

    });
