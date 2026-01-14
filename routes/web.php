<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::get('/sign-up', function () {
    return view('authentication.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('authentication.forgot-password');
})->name('forgot-password');

Route::get('/verify-code', function () {
    return view('authentication.verify');
})->name('verify');

Route::get('/set-password', function () {
    return view('authentication.reset');
})->name('reset');

Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('/tour-packages', function () {
    return view('tours.index');
})->name('tours');

Route::get('/tour-details', function () {
    return view('tours.show');
})->name('tours.show');

Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::get('/testimonials', function () {
    return view('testimonials.index');
})->name('testimonials');

Route::get('/add-testimonial', function () {
    return view('testimonials.create');
})->name('testimonials.create');

Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');

Route::get('/my-account', function () {
    return view('account.index');
})->name('account');

Route::get('/booking-step1', function () {
    return view('booking.step1-detail');
})->name('booking.step1');

Route::get('/booking-step2', function () {
    return view('booking.step2-user');
})->name('booking.step2');

Route::get('/booking-step3', function () {
    return view('booking.step3-payment');
})->name('booking.step3');

Route::get('/booking-success', function () {
    return view('booking.success');
})->name('booking.success');

Route::get('/gallery', function () {
    return view('gallery.index');
})->name('gallery');

Route::get('/search-tours', function () {
    return view('search.index');
})->name('search');
