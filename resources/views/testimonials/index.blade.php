@extends('layout.app')

@section('title', 'Testimonials')

@section('content')

    <!-- ================= HERO TESTIMONIALS ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/testimonials-hero.png" alt="Contact Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-white text-3xl md:text-4xl font-semibold">
            Our <span class="text-lightGreen">Testimonials</span>
        </h1>
    </section>

    <!-- ================= TESTIMONIALS CONTENT ================= -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">

            <!-- ===== Section Title ===== -->
            <div class="text-center mb-14">
                <p class="font-semibold text-red tracking-widest mb-6">
                    TESTIMONIALS
                </p>
                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    Traveler Testimonials
                </h2>
                <p class="text-darkGrey leading-relaxed">
                    Explore the stories and feedback from travelers who have<br>entrusted their journeys to us.
                </p>
            </div>

            <!-- ===== Rating Summary ===== -->
            <div class="flex flex-col md:flex-row items-center justify-center gap-10 mb-14">

                <!-- Average Rating -->
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-semibold text-black/90">4.9</p>
                    <div class="flex justify-center gap-1 mt-3">
                        @for ($i = 0; $i < 4; $i++)
                            <i class="fas fa-star text-yellow-400"></i>
                        @endfor
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    </div>
                    <p class="text-sm font-medium text-darkGrey mt-3">Average Rating</p>
                </div>

                <!-- Divider -->
                <div class="hidden md:block w-px h-24 bg-mediumGrey"></div>

                <!-- Total Reviews -->
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-semibold text-black/90">22</p>
                    <p class="text-sm font-medium text-darkGrey mt-3">Traveler Reviews</p>
                </div>
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

            <!-- ===== Reviews List ===== -->
            <h3 class="text-xl font-semibold text-black/90 mt-8 mb-4">
                All Reviews
            </h3>

            <div class="space-y-10">

                <!-- Review Item -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <!-- Image -->
                    <div class="relative rounded-2xl overflow-hidden h-full">
                        <img src="/images/bali1.png" alt="Traveler" class="absolute inset-0 w-full h-full object-cover">
                    </div>

                    <!-- Content -->
                    <div class="bg-softGrey rounded-xl shadow-sm px-8 py-6 relative">
                        <i class="fas fa-quote-right absolute top-6 right-6 text-2xl md:text-3xl text-mediumGrey"></i>

                        <p class="text-sm text-darkGrey mb-4 mt-1">2 November 2025</p>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-darkGreen flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-black/90 mb-1">
                                    Alpin Alvary & Satomi
                                </p>
                                <p class="text-sm text-darkGrey">Japan</p>
                            </div>
                        </div>

                        <div class="flex gap-1 mb-3">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            @endfor
                        </div>

                        <p class="text-sm font-medium text-darkGreen mb-4">
                            <span class="text-darkGrey">Tour Attended:</span>
                            Fireflies Tour
                        </p>

                        <p class="text-darkGrey text-sm leading-relaxed">
                            Ms. Apri and her staff are incredibly friendly and kind.
                            We thoroughly enjoyed every moment of our experience with the...
                        </p>

                        <div class="text-right">
                            <a href="#" class="inline-block mt-4 text-sm text-darkGreen font-medium
                            hover:text-darkGreen/60 transition">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Review Item -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <!-- Image -->
                    <div class="relative rounded-2xl overflow-hidden h-full">
                        <img src="/images/bali1.png" alt="Traveler" class="absolute inset-0 w-full h-full object-cover">
                    </div>

                    <!-- Content -->
                    <div class="bg-softGrey rounded-xl shadow-sm px-8 py-6 relative">
                        <i class="fas fa-quote-right absolute top-6 right-6 text-2xl md:text-3xl text-mediumGrey"></i>

                        <p class="text-sm text-darkGrey mb-4 mt-1">2 November 2025</p>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-darkGreen flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-black/90 mb-1">
                                    Alpin Alvary & Satomi
                                </p>
                                <p class="text-sm text-darkGrey">Japan</p>
                            </div>
                        </div>

                        <div class="flex gap-1 mb-3">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            @endfor
                        </div>

                        <p class="text-sm font-medium text-darkGreen mb-4">
                            <span class="text-darkGrey">Tour Attended:</span>
                            Fireflies Tour
                        </p>

                        <p class="text-darkGrey text-sm leading-relaxed">
                            Ms. Apri and her staff are incredibly friendly and kind.
                            We thoroughly enjoyed every moment of our experience with the...
                        </p>

                        <div class="text-right">
                            <a href="#" class="inline-block mt-4 text-sm text-darkGreen font-medium
                            hover:text-darkGreen/60 transition">
                                Read More
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
