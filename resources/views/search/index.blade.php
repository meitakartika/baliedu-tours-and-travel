@extends('layout.app')

@section('title', 'Testimonials')

@section('content')

    <!-- ================= HERO SEARCH ================= -->
<section class="relative h-[480px] md:h-[520px]">

    <!-- Background Image -->
    <img src="/images/search-hero.png"
         alt="Search Hero"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="relative z-10 h-full flex flex-col items-center justify-center px-6">

        <!-- Title -->
        <h1 class="text-lightGreen text-3xl md:text-4xl font-semibold mb-2 md:mb-10">
            Search <span class="text-white">Tours</span>
        </h1>

        <!-- Search Box -->
            <div
                class="mt-10 bg-lightGrey/60 backdrop-blur-md rounded-l p-4 md:p-6 
                        flex flex-col md:flex-row items-stretch md:items-center
                        gap-4 md:gap-0 max-w-4xl mx-auto">

                <!-- Location -->
                <div class="flex items-center gap-5 px-4 lg:border-r lg:border-white">
                    <i class="fa-solid fa-location-dot text-white text-2xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">Location</p>
                        <input type="text" placeholder="Search location"
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Duration -->
                <div class="flex items-center gap-5 px-4 lg:pl-12 lg:border-r md:border-white"> <i
                        class="fa-solid fa-clock text-white text-2xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">Duration</p> <input type="number"
                            placeholder="Pick a duration"
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Guests -->
                <div class="flex items-center gap-5 px-4 lg:pl-12">
                    <i class="fa-solid fa-user-group text-white text-xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">Guests</p>
                        <input type="number" placeholder="How many guests?"
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Button -->
                <button
                    class="bg-darkGreen hover:bg-darkGreen/90 transition
                       text-white rounded-lg
                       w-full md:w-14 h-12 flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

    </div>
</section>

    <!-- ================= TOURS CONTENT ================= -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">

             <!-- SECTION TITLE -->
        <div class="mb-10">
            <h2 class="text-xl md:text-2xl font-semibold text-black">
                Search Results
            </h2>
        </div>

    <!-- ===== TOUR CARDS ===== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

                <!-- CARD -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                    <!-- Image -->
                    <div class="relative">
                        <img src="/images/about-hero.png" class="w-full h-[220px] object-cover" alt="">
                        <span class="absolute top-6 left-6 bg-darkGreen text-white text-xs px-3 py-2 rounded-full">
                            Special Package
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="p-6">

                        <p class="text-sm text-darkGrey mb-2">Night Adventures</p>

                        <h3 class="font-semibold text-lg mb-2">
                            Fireflies Tour
                        </h3>

                        <!-- Rating -->
                        <div class="flex items-center gap-1 text-sm mb-3">
                            <div class="flex items-center text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>

                            <span class="font-medium ml-1">4.9</span>
                            <span class="text-darkGrey">(2 reviews)</span>
                        </div>

                        <p class="text-sm text-darkGrey mb-4 line-clamp-2">
                            Watching and learning about fireflies is a must-see activity during your visit in Bali.
                        </p>

                        <!-- Meta -->
                        <div class="flex items-center justify-between text-xs font-medium text-darkGreen mb-5">

                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock"></i>
                                <span>1 day</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-friends"></i>
                                <span>2–10 guests</span>
                            </div>

                        </div>

                        <div class="border-t border-lightGrey my-6"></div>

                        <!-- Price -->
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col justify-center">
                                <p class="text-xs text-darkGrey mb-1">Starting from</p>
                                <p class="font-semibold">Rp500.000</p>
                            </div>

                            <a href="#"
                                class="bg-darkGreen text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 self-center">
                                Read More
                                <i class="fas fa-angle-double-right text-xs"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection