<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::get('/testimonials', function () {
    return view('testimonials.index');
})->name('testimonials');

Route::get('/add-testimonial', function () {
    return view('testimonials.create');
})->name('testimonials.create');

Route::get('/contact', [ContactInfoController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/my-account', [AccountController::class, 'index'])->name('account');
    Route::post('/my-account/profile', [AccountController::class, 'updateProfile'])->name('account.profile');
    Route::post('/my-account/security', [AccountController::class, 'updateSecurity'])->name('account.security');
});

Route::get('/booking/step1', [BookingController::class, 'step1'])
    ->name('booking.step1');
Route::middleware('auth')->group(function () {
    Route::get('/booking-step2', function () {return view('booking.step2-user');})->name('booking.step2');
    Route::get('/booking-step3', function () {return view('booking.step3-payment');})->name('booking.step3');
    Route::get('/booking-success', function () {return view('booking.success');})->name('booking.success');
});

Route::get('/gallery', function () {
    return view('gallery.index');
})->name('gallery');

Route::get('/search-tours', function () {
    return view('search.index');
})->name('search');

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/customers', [UserController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [UserController::class, 'create'])->name('customers.create');
    Route::get('/customers/{customer}/edit', [UserController::class, 'edit'])->name('customers.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/testimonials-admin', [PackageReviewController::class, 'index'])->name('admin.testimonials.index');
    Route::get('/testimonials-admin/edit', [PackageReviewController::class, 'edit'])->name('admin.testimonials.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/contact-info', [ContactInfoController::class, 'index'])->name('contact.info.index');
    Route::get('/contact-info/create', [ContactInfoController::class, 'create'])->name('contact.info.create');
    Route::get('/contact-info/edit', [ContactInfoController::class, 'edit'])->name('contact.info.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/contact-messages', [ContactMessagesController::class, 'index'])->name('contact.messages.index');
    Route::get('/contact-messages/show', [ContactMessagesController::class, 'show'])->name('contact.messages.show');
    Route::post('/contact-message', [ContactMessagesController::class, 'store'])->name('contact.messages.store');
    Route::delete('/contact-messages/{contactMessage}', [ContactMessagesController::class, 'destroy'])->name('contact.messages.destroy');
});

Route::post('/contact/send', [ContactMessagesController::class, 'send'])
    ->name('contact.send');


    Route::get('/package-category', [CategoryController::class, 'index'])->name('package.category.index');
    Route::get('/package-category/create', [CategoryController::class, 'create'])->name('package.category.create');
    Route::get('/package-category/edit', [CategoryController::class, 'edit'])->name('package.category.edit');


    Route::get('/package-type', [TypeController::class, 'index'])->name('package.type.index');
    Route::get('/package-type/create', [TypeController::class, 'create'])->name('package.type.create');
    Route::get('/package-type/edit', [TypeController::class, 'edit'])->name('package.type.edit');


    Route::get('/package-itinerary', [ItineraryController::class, 'index'])->name('package.itinerary.index');
    Route::get('/package-itinerary/create', [ItineraryController::class, 'create'])->name('package.itinerary.create');
    Route::get('/package-itinerary/edit', [ItineraryController::class, 'edit'])->name('package.itinerary.edit');


    Route::get('/package-list', [PackageListController::class, 'index'])->name('package.list.index');
    Route::get('/package-list/create', [PackageListController::class, 'create'])->name('package.list.create');
    Route::get('/package-list/edit', [PackageListController::class, 'edit'])->name('package.list.edit');


    Route::get('/package-admin', [PackageController::class, 'index'])->name('package.tour.index');
    Route::get('/package-admin/create', [PackageController::class, 'create'])->name('package.tour.create');
    Route::get('/package-admin/edit', [PackageController::class, 'edit'])->name('package.tour.edit');


    Route::get('/booking-admin', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/booking-admin/edit', [BookingController::class, 'edit'])->name('bookings.edit');

Route::get('/account-admin', function () {
    return view('admin.account.index');
})->name('account');