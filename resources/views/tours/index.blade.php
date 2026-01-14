@extends('layout.app')

@section('title', 'Testimonials')

@section('content')

    <!-- ================= HERO TOURS ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/tours1-hero.png" alt="Tours Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-lightGreen text-3xl md:text-4xl font-semibold">
            Special <span class="text-white">Package</span>
        </h1>
    </section>

    <!-- ================= TOURS CONTENT ================= -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- ===== SEARCH BAR ===== -->
            <div class="mb-8 relative">
                <input type="text" placeholder="Find the tour package you want..."
                    class="w-full rounded-full border border-mediumGrey/30
                   py-4 pl-6 pr-12 text-sm
                   focus:outline-none focus:ring-1 focus:ring-darkGreen" />
                <i class="fas fa-search absolute right-6 top-1/2 -translate-y-1/2 text-mediumGrey"></i>
            </div>

            <!-- ===== Filter & Sort ===== -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">

                <!-- Filter -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-darkGrey mb-3 ml-1">
                        <i class="fas fa-filter text-darkGrey"></i>
                        <span>Filter by type of tour</span>
                    </label>
                    <select
                        class="w-full border border-mediumGrey/30 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-darkGreen">
                        <option>All Types</option>
                        <option>Adventure Tour</option>
                        <option>Culture Tour</option>
                        <option>Honeymoon</option>
                    </select>
                </div>

                <!-- Sort -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-darkGrey mb-3 ml-1">
                        <i class="fas fa-sort-amount-down-alt text-darkGrey"></i>
                        <span>Sort by</span>
                    </label>
                    <select
                        class="w-full border border-mediumGrey/30 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-darkGreen">
                        <option>Highest Rated</option>
                        <option>Newest</option>
                        <option>Oldest</option>
                    </select>
                </div>
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

                            <a href="{{ route('tours.show') }}"
                                class="bg-darkGreen text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 self-center">
                                Read More
                                <i class="fas fa-angle-double-right text-xs"></i>
                            </a>
                        </div>

                    </div>
                </div>

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

            <!-- ===== Pagination ===== -->
            <div class="flex justify-center mt-20">
                <nav class="flex items-center gap-2">
                    <button class="hidden md:inline w-11 h-11 rounded-full border text-darkGrey/80">
                        «
                    </button>
                    <button class="w-10 h-10 md:w-11 md:h-11 rounded-full border text-darkGrey/80">
                        ‹
                    </button>
                    <button class="w-10 h-10 md:w-11 md:h-11 rounded-full bg-darkGreen text-white font-medium">
                        1
                    </button>
                    <button class="w-10 h-10 md:w-11 md:h-11 rounded-full border text-darkGrey">
                        2
                    </button>
                    <button class="w-10 h-10 md:w-11 md:h-11 rounded-full border text-darkGrey">
                        3
                    </button>
                    <span class="hidden md:inline px-2 text-darkGrey">...</span>
                    <button class="hidden md:inline w-11 h-11 rounded-full border text-darkGrey">
                        10
                    </button>
                    <button class="w-10 h-10 md:w-11 md:h-11 rounded-full border text-darkGrey/80">
                        ›
                    </button>
                    <button class="hidden md:inline w-11 h-11 rounded-full border text-darkGrey/80">
                        »
                    </button>
                </nav>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
@endpush
