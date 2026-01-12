@extends('layout.app')

@section('title', 'My Account')

@section('content')

<!-- ================= HERO ACCOUNT ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/account-hero.png" alt="Contact Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-white text-3xl md:text-4xl font-semibold">
            My <span class="text-lightGreen">Account</span>
        </h1>
    </section>

<div class="max-w-7xl mx-auto px-6 py-12">

    <!-- WRAPPER CARD -->
    <div class="bg-white rounded-xl shadow grid grid-cols-1 md:grid-cols-4">

        <!-- SIDEBAR -->
<aside class="flex flex-col
    border-b border-mediumGrey/20
    md:border-b-0 md:border-r border-mediumGrey/20">

    <!-- PROFILE HEADER -->
    <div class="flex flex-col items-center text-center p-6">

        <!-- Avatar -->
        <div class="relative">
            <div class="w-20 h-20 rounded-full bg-mediumGrey
                        flex items-center justify-center text-white text-4xl">
                <i class="fa-solid fa-user"></i>
            </div>

            <!-- Edit Icon -->
            <button
                class="absolute bottom-0 right-0 w-7 h-7 rounded-full 
                bg-darkGreen border-2 border-white
                       flex items-center justify-center text-white text-xs">
                <i class="fa-solid fa-pen"></i>
            </button>
        </div>

        <!-- Name -->
        <h3 class="mt-5 text-lg font-semibold text-darkGrey mb-2">
            John Doe
        </h3>

        <!-- Email -->
        <p class="text-sm text-darkGrey">
            johndoe@gmail.com
        </p>
    </div>

    <!-- MENU -->
    <ul class="text-sm font-medium py-2">

        <li>
            <a href="?tab=profile"
               class="flex items-center gap-3 w-full px-6 py-4
               {{ request('tab','profile')=='profile'
                   ? 'bg-darkGreen text-white'
                   : 'text-darkGrey hover:bg-lightGrey' }}">
                Profile Information
            </a>
        </li>

        <li>
            <a href="?tab=booking"
               class="flex items-center gap-3 w-full px-6 py-4
               {{ request('tab')=='booking'
                   ? 'bg-darkGreen text-white'
                   : 'text-darkGrey hover:bg-lightGrey' }}">
                My Booking
            </a>
        </li>

        <li>
    <a href="?tab=testimonial"
       class="relative flex items-center w-full px-6 py-4
       {{ request('tab')=='testimonial'
           ? 'bg-darkGreen text-white'
           : 'text-darkGrey hover:bg-lightGrey' }}">
       
        <span>My Testimonial</span>

        <!-- Badge -->
        <span class="ml-3 bg-red 
        text-white text-xs 
        w-5 h-5 flex items-center justify-center rounded-full">
        1
    </span>

    </a>
</li>

    </ul>

</aside>

        <!-- CONTENT -->
        <main class="md:col-span-3 p-8 min-h-[800px]">
            @if(request('tab') == 'booking')
                @include('account.tabs.booking')

            @elseif(request('tab') == 'testimonial')
                @include('account.tabs.testimonial')

            @else
                @include('account.tabs.profile')
            @endif
        </main>

    </div>

</div>
@endsection