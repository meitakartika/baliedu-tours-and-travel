@extends('layout.app')

@section('title', 'Detail Tour')

@section('content')

    <!-- ================= HERO DETAIL TOUR ================= -->
    <section class="relative h-[380px] md:h-[420px]">

        <!-- Background Image -->
        <img src="/images/tours1-hero.png" alt="Detail Tour Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- CONTENT WRAPPER -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 h-full">

            <!-- Back -->
            <a href="{{ route('tours') }}"
                class="absolute bottom-6 md:bottom-8 left-6 inline-flex items-center gap-3
                  text-white text-sm md:text-base font-medium hover:text-lightGreen transition">
                <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
                Back to Special Packages
            </a>

            <!-- Title -->
            <div class="h-full flex items-center justify-center">
                <h1 class="text-lightGreen text-3xl md:text-4xl font-semibold">
                    Fireflies <span class="text-white">Tour</span>
                </h1>
            </div>

        </div>
    </section>

    <!-- ================= DETAIL CONTENT ================= -->
    <section class="max-w-7xl mx-auto px-6 py-16 pb-20 grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- LEFT : SCROLLABLE OVERVIEW -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-lg p-8
                    max-h-[760px] overflow-y-auto pr-6">

                <!-- Tour Overview -->
                <h2 class="text-xl font-semibold mb-4">Tour Overview</h2>
                <p class="text-darkGrey leading-relaxed mb-4">
                    Seeing and learning more about fireflies is a must-see activity when visiting Bali.
                    These fascinating insects offer a unique and memorable tourism experience in Ubud.
                </p>
                <p class="text-darkGrey leading-relaxed mb-4">
                    In Ubud, fireflies can be observed in rural paddy fields, surrounded by lush vegetation.
                    This experience allows you to learn about the behavior and uniqueness of fireflies.
                </p>

                <div class="border-t border-lightGrey my-8"></div>

                <!-- Itinerary -->
                <h3 class="text-lg font-semibold mb-4">Itinerary</h3>

                <div class="relative pl-8 space-y-6">

                    <!-- Vertical Line -->
                    <div class="absolute left-2 top-2 bottom-2 h-[70%] w-px bg-darkGreen"></div>

                    <!-- Item 1 -->
                    <div class="relative">
                        <!-- Bullet -->
                        <span class="absolute -left-8 top-1 w-4 h-4 rounded-full bg-darkGreen"></span>

                        <h4 class="font-medium text-black mb-2">18.00: Dinner</h4>
                        <ul class="list-disc ml-5 text-darkGrey space-y-1">
                            <li>The journey begins with dinner at a local restaurant in Ubud.</li>
                            <li>
                                Serving an à la carte menu with a choice of chicken, fish, or duck,
                                prepared using traditional Balinese spices.
                            </li>
                        </ul>
                    </div>

                    <!-- Item 2 -->
                    <div class="relative">
                        <!-- Bullet (Hollow) -->
                        <span
                            class="absolute -left-8 top-1 w-4 h-4 rounded-full
                   border-2 border-darkGreen bg-white">
                        </span>

                        <h4 class="font-medium text-black mb-2">
                            19.00: Journey to the Fireflies Location
                        </h4>
                        <ul class="list-disc ml-5 text-darkGrey space-y-1">
                            <li>After dinner, the journey continues to the fireflies viewing area.</li>
                        </ul>
                    </div>

                    <!-- Item 3 -->
                    <div class="relative">
                        <!-- Bullet -->
                        <span class="absolute -left-8 top-1 w-4 h-4 rounded-full bg-darkGreen"></span>

                        <h4 class="font-medium text-black mb-2">
                            19.30 – 22.00: Fireflies Tour
                        </h4>
                        <ul class="list-disc ml-5 mb-4 text-darkGrey space-y-1">
                            <li>
                                Enjoy the beauty of fireflies glowing among the trees and rice fields.
                            </li>
                            <li>
                                The patterned and synchronized glow of fireflies can be captured
                                as a unique moment during your holiday in Bali.
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="border-t border-lightGrey my-8"></div>

                <!-- What's Included -->
                <h3 class="text-lg font-semibold mb-4">What’s Included</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-darkGrey mb-4">
                    <div>
                        <p class="font-medium text-black mb-2">Includes</p>
                        <ul class="list-disc ml-5 space-y-1">
                            <li>Private pickup & drop-off</li>
                            <li>Professional guide</li>
                            <li>Dinner</li>
                            <li>Mineral water</li>
                        </ul>
                    </div>

                    <!-- Not Includes + Must Bring -->
                    <div class="space-y-6">
                        <div>
                            <p class="font-medium text-black mb-2">Not Includes</p>
                            <ul class="list-disc ml-5 space-y-1">
                                <li>Additional food</li>
                                <li>Personal expenses</li>
                            </ul>
                        </div>

                        <div>
                            <p class="font-medium text-black mb-2">Must Bring</p>
                            <ul class="list-disc ml-5 space-y-1">
                                <li>Comfortable clothes</li>
                                <li>Insect repellent</li>
                                <li>Camera or smartphone</li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="border-t border-lightGrey my-8"></div>

                <!-- Payment -->
                <h3 class="text-lg font-semibold mb-4">Payment</h3>
                <p class="text-darkGrey mb-8">
                    Reservations will only be confirmed after we receive payment via bank transfer
                    to the following account:
                </p>

                <!-- Bank Transfer -->
                <h4 class="font-medium text-black mb-3">Bank Transfer</h4>

                <div class="space-y-2 text-darkGrey mb-8">

                    <div class="grid grid-cols-[160px_12px_1fr]">
                        <span>Bank Name</span>
                        <span>:</span>
                        <span>BCA KCP Sanur Raya</span>
                    </div>

                    <div class="grid grid-cols-[160px_12px_1fr]">
                        <span>Account Number</span>
                        <span>:</span>
                        <span>6700 66 56 99</span>
                    </div>

                    <div class="grid grid-cols-[160px_12px_1fr]">
                        <span>Account Name</span>
                        <span>:</span>
                        <span>Baliedu Tours and Travel CV</span>
                    </div>

                    <div class="grid grid-cols-[160px_12px_1fr]">
                        <span>Address</span>
                        <span>:</span>
                        <span>
                            Rukan Golf Arcade, Jalan Bypass I Gusti Ngurah Rai 126,
                            Sanur Kaja, Denpasar Selatan, Kota Denpasar 80227,
                            Bali-Indonesia
                        </span>
                    </div>

                </div>

                <!-- Payment Terms -->
                <h4 class="font-medium text-black mb-3">Payment Terms</h4>
                <ul class="list-disc ml-5 text-darkGrey space-y-2 mb-8">
                    <li>
                        All bookings can be made through our website or via Baliedu’s WhatsApp contact.
                    </li>
                    <li>
                        Full payment (100%) is required immediately after making a reservation.
                    </li>
                    <li>
                        Bank transfer fees are the responsibility of the client.
                    </li>
                </ul>

                <!-- Cancellation Policy -->
                <h3 class="font-medium mb-3">Cancellation Policy</h3>
                <ul class="list-disc ml-5 text-darkGrey space-y-2 mb-8">
                    <li>
                        Cancellations made within 15 days prior to arrival will be subject to a
                        50% charge of the total payment.
                    </li>
                    <li>
                        Cancellations made less than 15 days prior to arrival will be subject to a
                        100% charge of the total payment.
                    </li>
                </ul>

                <!-- Other Important Terms -->
                <h3 class="font-medium mb-3">Other Important Terms</h3>
                <ul class="list-disc ml-5 text-darkGrey space-y-2">
                    <li>
                        Our tours do not include travel insurance. If required, guests are advised
                        to arrange their own insurance.
                    </li>
                    <li>
                        We act as an intermediary travel agent that packages tour programs by
                        combining transportation, accommodation, restaurants, and other related
                        components. Therefore, we are not responsible for any delays, schedule
                        changes, losses, accidents, theft, or other unforeseen circumstances that
                        may occur, including but not limited to flight delays or schedule changes.
                        As such, we cannot be held liable for any events beyond our control.
                    </li>
                </ul>

            </div>
        </div>

        <!-- RIGHT : BOOKING CARD -->
        <div class="sticky top-24">
            <div
                class="border-r-4 border-b-4 border-lightGreen rounded-3xl p-8 shadow-lg bg-white
                h-[760px] flex flex-col justify-center">

                <p class="text-sm text-darkGrey text-center mb-3">Starting from</p>
                <h3 class="text-3xl font-semibold text-darkGreen text-center mb-3">Rp500.000</h3>
                <p class="text-sm text-darkGrey text-center mb-10">Per person</p>

                <!-- Duration & Group Size -->
                <div class="flex justify-between mb-10 px-6">

                    <!-- Duration -->
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-clock text-black text-lg"></i>
                        <div class="flex flex-col justify-center">
                            <p class="text-xs text-darkGrey mb-1">Duration</p>
                            <p class="text-sm text-darkGrey font-medium">1 Days</p>
                        </div>
                    </div>

                    <!-- Group Size -->
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-user-friends text-black text-lg"></i>
                        <div class="flex flex-col justify-center">
                            <p class="text-xs text-darkGrey mb-1">Group Size</p>
                            <p class="text-sm text-darkGrey font-medium">2–10 guests</p>
                        </div>
                    </div>

                </div>

                <hr class="mb-8">

                <!-- BOOKING -->
                <p class="font-semibold mb-6 text-left">Booking</p>

                <div class="mb-5">
                    <label class="block text-sm font-medium mb-1">Date</label>
                    <div class="relative">
                        <input type="date"
                            class="w-full bg-lightGrey rounded-md px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-darkGreen">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium mb-1">Number of Guests</label>
                    <div class="relative">
                        <select
                            class="w-full bg-lightGrey rounded-md px-4 py-3 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-darkGreen">
                            <option>2 people</option>
                            <option>3 people</option>
                            <option>4 people</option>
                            <option>5 people</option>
                            <option>6 people</option>
                            <option>7 people</option>
                            <option>8 people</option>
                            <option>9 people</option>
                            <option>10 people</option>
                        </select>
                        <i
                            class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-mediumGrey pointer-events-none"></i>
                    </div>
                </div>

                <button
                    class="w-full bg-darkGreen text-white py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition mb-10">
                    BOOK NOW
                </button>

                <hr class="mb-7">

                <p class="text-xs text-center text-darkGrey">
                    Click the button above to make a booking.
                </p>

            </div>
        </div>

    </section>

    <!-- ================= GALLERY ================= -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold">Tour Gallery</h2>

            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-full bg-lightGrey flex items-center justify-center hover:softGrey">
                    <i class="fa-solid fa-chevron-left text-mediumGrey"></i>
                </button>
                <button class="w-10 h-10 rounded-full bg-darkGreen flex items-center justify-center hover:bg-darkGreen/90">
                    <i class="fa-solid fa-chevron-right text-white"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

            <!-- Big Left -->
            <img src="/images/bali1.png" class="rounded-xl object-cover w-full h-[420px] md:col-span-2 md:row-span-2">

            <!-- Middle Top -->
            <img src="/images/about-hero.png" class="rounded-xl object-cover w-full h-[200px]">

            <!-- Right Tall -->
            <img src="/images/bali3.png" class="rounded-xl object-cover w-full h-[420px] md:row-span-2">

            <!-- Middle Bottom -->
            <img src="/images/category-4.png" class="rounded-xl object-cover w-full h-[200px]">

        </div>
    </section>

    <!-- ================= REVIEW ================= -->
    <section class="max-w-7xl mx-auto px-6 pb-20">

        <h2 class="text-2xl font-semibold mb-6">Tour Review</h2>

        <!-- Rating summary -->
        <div class="flex items-start gap-12 mb-8">

            <!-- Rating number + stars -->
            <div class="flex flex-col">
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-medium">4,9</span>
                    <span class="text-sm text-mediumGrey">5 reviews</span>
                </div>

                <div class="flex gap-1 text-yellow-400 mt-2">
                    <i class="fa-solid fa-star text-lg"></i>
                    <i class="fa-solid fa-star text-lg"></i>
                    <i class="fa-solid fa-star text-lg"></i>
                    <i class="fa-solid fa-star text-lg"></i>
                    <i class="fa-solid fa-star-half-stroke text-lg"></i>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex gap-4 self-end">
                <span class="flex items-center gap-2 bg-lightGrey px-4 py-2 rounded-lg text-sm">
                    <i class="fa-solid fa-camera text-darkGrey"></i> Photo (2)
                </span>
                <span class="flex items-center gap-2 bg-lightGrey px-4 py-2 rounded-lg text-sm">
                    5 <span class="text-yellow-400">★</span> (4)
                </span>
                <span class="flex items-center gap-2 bg-lightGrey px-4 py-2 rounded-lg text-sm">
                    4 <span class="text-yellow-400">★</span> (1)
                </span>
            </div>
        </div>

        <div class="my-12 border-t border-mediumGrey/20"></div>

        <!-- Reviews -->
        <div class="divide-y">

            <!-- Review item -->
            <div class="pb-12">

                <!-- Date -->
                <p class="text-sm text-mediumGrey mb-3">2 November 2025</p>

                <!-- Main row -->
                <div class="flex gap-6">

                    <!-- Avatar -->
                    <div class="w-14 h-14 bg-darkGreen rounded-full flex items-center justify-center text-white shrink-0">
                        <i class="fa-solid fa-user text-xl"></i>
                    </div>

                    <!-- Content row -->
                    <div class="flex flex-1 gap-6">

                        <!-- Name + country -->
                        <div class="min-w-auto mt-1 mr-1">
                            <p class="font-semibold leading-tight mb-1">PHILIPA</p>
                            <p class="text-sm text-darkGrey">Canada</p>
                        </div>

                        <!-- Review -->
                        <p class="text-darkGrey leading-relaxed flex-1">
                            I really enjoyed catching a few fireflies we saw. I couldn’t believe how tiny they were.
                            It was unbelievable! Made and Apni were excellent guides, and they even took us to an
                            amazing restaurant called Sawah Indah. I highly recommend spending your evening with them!
                        </p>

                    </div>

                </div>

                <!-- Rating -->
                <div class="flex gap-1 text-yellow-400 text-sm">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

            </div>

            <!-- Review item with photo -->
            <div class="py-12">

                <!-- Date -->
                <p class="text-sm text-mediumGrey mb-3">2 November 2025</p>

                <div class="flex gap-6 items-start">

                    <!-- Avatar -->
                    <div class="w-14 h-14 bg-darkGreen rounded-full flex items-center justify-center text-white shrink-0">
                        <i class="fa-solid fa-user text-xl"></i>
                    </div>

                    <!-- Main content row -->
                    <div class="flex flex-1 gap-6">

                        <!-- Name + country -->
                        <div class="min-w-auto mt-1 mr-1">
                            <p class="font-semibold leading-tight mb-1">JESSICA</p>
                            <p class="text-sm text-darkGrey">Canada</p>
                        </div>

                        <!-- Review -->
                        <p class="text-darkGrey leading-relaxed flex-1">
                            An amazing experience! It started with dinner at a restaurant overlooking rice fields.
                            The food was delicious, and the sunset view was stunning. As night fell, we visited three
                            different locations to see fireflies. We were thrilled! It was a beautiful experience.
                            Our guides were friendly and informative. We highly recommend this tour!
                        </p>

                        <!-- Photo -->
                        <div class="relative w-32 h-24 rounded-xl overflow-hidden shrink-0">
                            <img src="/images/bali3.png" class="object-cover w-full h-full">
                            <div
                                class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded flex items-center gap-1">
                                <i class="fa-regular fa-image"></i> +2
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Rating -->
                <div class="flex gap-1 text-yellow-400 text-sm">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

            </div>

        </div>

        <!-- View more -->
        <div class="text-center mt-10">
            <button class="text-darkGreen font-medium flex items-center gap-3 mx-auto hover:text-darkGreen/80">
                View More Reviews
                <i class="fa-solid fa-chevron-down"></i>
            </button>
        </div>

    </section>

    <!-- ================= CBF ================= -->

    <section class="max-w-7xl mx-auto px-6 pb-20">

        <h2 class="text-2xl font-semibold mb-6">Similar Experiences</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

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
        </div>
    </section>

@endsection

@push('scripts')
@endpush
