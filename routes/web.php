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

Route::get('/gallery', function () {
    return view('gallery.index');
})->name('gallery');
