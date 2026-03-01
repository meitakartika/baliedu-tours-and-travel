@extends('layout.app')

@section('title', 'Detail Tour')

@section('content')

    <!-- ================= HERO DETAIL TOUR ================= -->
    <section class="relative h-[380px] md:h-[420px]">

        <!-- Background Image -->
        <img src="{{ asset('storage/' . $package->image_url) }}" class="absolute inset-0 w-full h-full object-cover">

        <!-- CONTENT WRAPPER -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 h-full">

            <!-- Back -->
            <a href="{{ route('tours.category', $package->type->category->id) }}"
                class="absolute bottom-6 md:bottom-8 left-6 inline-flex items-center gap-3
                  text-white text-sm md:text-base font-medium hover:text-lightGreen transition">
                <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
                Back to
                {{ app()->getLocale() === 'id' ? $package->type->category->name_id : $package->type->category->name_en }}
            </a>

            <!-- Title -->
            <div class="h-full flex items-center justify-center">
                <h1 class="text-lightGreen text-3xl md:text-4xl font-semibold">
                    {{ app()->getLocale() === 'id' ? $package->name_id : $package->name_en }}
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
                    {!! nl2br(e(app()->getLocale() === 'id' ? $package->overview_id : $package->overview_en)) !!}
                </p>

                <div class="border-t border-lightGrey my-8"></div>

                <!-- Itinerary -->
                <h3 class="text-lg font-semibold mb-3">Itinerary</h3>

                @php
                    $grouped = $package->itineraries->groupBy('day');
                    $firstDay = $grouped->keys()->first();
                    $lastDay = $grouped->keys()->last();
                @endphp

                @foreach ($grouped as $day => $itineraries)
                    <!-- DAY TITLE -->
                    <h4 class="text-base font-semibold text-darkGreen mt-5 mb-4">
                        Day {{ $day }}
                    </h4>

                    <div class="relative">

                        <!-- GARIS FULL -->
                        <div class="absolute left-2 top-2 bottom-2 w-px bg-darkGreen"></div>

                        <div class="space-y-8">

                            @foreach ($itineraries as $index => $itinerary)
                                <div class="relative pl-8">

                                    <!-- BULLET (CENTER PERFECT KE GARIS) -->
                                    <span
                                        class="absolute left-2 -translate-x-1/2 top-2 w-4 h-4 rounded-full
    {{ ($day == $firstDay && $index === 0) || ($day == $lastDay && $index === $itineraries->count() - 1)
        ? 'bg-darkGreen'
        : 'bg-white border-2 border-darkGreen' }}">
                                    </span>

                                    <!-- CONTENT -->
                                    <h4 class="font-medium text-black mb-2">
                                        {{ $itinerary->time }}
                                        {{ app()->getLocale() === 'id' ? $itinerary->title_id : $itinerary->title_en }}
                                    </h4>

                                    <ul class="list-disc ml-5 text-darkGrey space-y-1">
                                        @foreach ($itinerary->details as $detail)
                                            <li>
                                                {{ app()->getLocale() === 'id' ? $detail->description_id : $detail->description_en }}
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endforeach

                <div class="border-t border-lightGrey my-8"></div>

                <!-- What's Included -->
                <h3 class="text-lg font-semibold mb-4">What’s Included</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-darkGrey mb-4">
                    @if ($package->includes->isNotEmpty())
                        <div>
                            <p class="font-medium text-black mb-2">Includes</p>
                            <ul class="list-disc ml-5 space-y-1">
                                @foreach ($package->includes as $item)
                                    <li>{{ app()->getLocale() == 'id' ? $item->content_id : $item->content_en }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-6">
                        @if ($package->notIncludes->isNotEmpty())
                            <div>
                                <p class="font-medium text-black mb-2">Not Includes</p>
                                <ul class="list-disc ml-5 space-y-1">
                                    @foreach ($package->notIncludes as $item)
                                        <li>{{ app()->getLocale() == 'id' ? $item->content_id : $item->content_en }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($package->mustBring->isNotEmpty())
                            <div>
                                <p class="font-medium text-black mb-2">Must Bring</p>
                                <ul class="list-disc ml-5 space-y-1">
                                    @foreach ($package->mustBring as $item)
                                        <li>{{ app()->getLocale() == 'id' ? $item->content_id : $item->content_en }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                <h3 class="text-3xl font-semibold text-darkGreen text-center mb-3">
                    Rp{{ number_format($package->price, 0, ',', '.') }}</h3>
                <p class="text-sm text-darkGrey text-center mb-10">Per person</p>

                <!-- Duration & Group Size -->
                <div class="flex justify-between mb-8 px-6">

                    <!-- Duration -->
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-clock text-black text-lg"></i>
                        <div class="flex flex-col justify-center">
                            <p class="text-xs text-darkGrey mb-1">Duration</p>
                            <p class="text-sm text-darkGrey font-medium">
                                {{ $package->duration }} {{ $package->duration === 1 ? 'Day' : 'Days' }}
                            </p>
                        </div>
                    </div>

                    <!-- Group Size -->
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-user-friends text-black text-lg"></i>
                        <div class="flex flex-col justify-center">
                            <p class="text-xs text-darkGrey mb-1">Group Size</p>
                            <p class="text-sm text-darkGrey font-medium">
                                {{ $package->guest_min }}–{{ $package->guest_max }} guests</p>
                        </div>
                    </div>

                </div>

                <hr class="mb-7">

                <!-- BOOKING -->
                <p class="font-semibold mb-6 text-left">Booking</p>

                <form action="{{ route('booking.submit') }}" method="POST">
                    @csrf

                    <!-- hidden package id -->
                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <!-- DATE -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium mb-1">Date</label>
                        <div class="relative">
                            <input type="date" name="date" value="{{ old('date') }}"
                                class="w-full bg-lightGrey rounded-md px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-darkGreen @error('date') border border-red @enderror">
                        </div>
                        @error('date')
                            <p class="text-xs text-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- GUESTS -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium mb-1">Number of Guests</label>
                        <div class="relative">
                            <select name="guests"
                                class="w-full bg-lightGrey rounded-md px-4 py-3 text-sm appearance-none
           focus:outline-none focus:ring-2 focus:ring-darkGreen
           @error('guests') border border-red @enderror">

                                <option value="" disabled selected hidden>
                                    Select number of guests
                                </option>

                                @for ($i = $package->guest_min; $i <= $package->guest_max; $i++)
                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i === 1 ? 'person' : 'people' }}
                                    </option>
                                @endfor
                            </select>
                            <i
                                class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-mediumGrey pointer-events-none"></i>
                        </div>
                        @error('guests')
                            <p class="text-xs text-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (Auth::check())
                        <button type="submit"
                            class="w-full block text-center bg-darkGreen text-white py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition mb-4">
                            BOOK NOW
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full block text-center bg-darkGreen text-white py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition mb-4">
                            BOOK NOW
                        </a>
                    @endif

                    @if ($adminPhone)
                        @php
                            $rawPhone = app()->getLocale() === 'id' ? $adminPhone->value_id : $adminPhone->value_en;

                            // Hapus semua karakter selain angka
                            $phone = preg_replace('/[^0-9]/', '', $rawPhone);
                            $packageName = app()->getLocale() === 'id' ? $package->name_id : $package->name_en;

                            $message = urlencode("Hi, I want to ask about {$packageName}");
                        @endphp

                        <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                            class="w-full flex items-center justify-center gap-2
              border border-darkGreen text-darkGreen text-sm py-3 rounded-lg font-medium
              hover:bg-darkGreen/10 transition mb-8">
                            <i class="fa-brands fa-whatsapp"></i>
                            Chat Admin
                        </a>
                    @endif

                    <hr class="mb-7">

                    <p class="text-xs text-center text-darkGrey">
                        Click the button above to make a booking.
                    </p>
                </form>
            </div>
        </div>

    </section>

    <!-- ================= GALLERY ================= -->
    <section class="max-w-7xl mx-auto px-6 pb-20">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold">Tour Gallery</h2>

            <div class="flex gap-2">
                <button id="prevBtn"
                    class="w-10 h-10 rounded-full bg-lightGrey flex items-center justify-center hover:bg-mediumGrey/20">
                    <i class="fa-solid fa-chevron-left text-mediumGrey"></i>
                </button>
                <button id="nextBtn"
                    class="w-10 h-10 rounded-full bg-darkGreen flex items-center justify-center hover:bg-darkGreen/90">
                    <i class="fa-solid fa-chevron-right text-white"></i>
                </button>
            </div>
        </div>

        <div class="overflow-hidden">
            <div id="galleryWrapper" class="flex transition-transform duration-500">

                @forelse ($package->galleries->values()->chunk(4) as $chunk)
                    @php $chunk = $chunk->values(); @endphp

                    <div class="min-w-full">

                        @if (isset($chunk[0], $chunk[1], $chunk[2], $chunk[3]))
                            <div class="grid grid-cols-3 gap-4">

                                <div class="row-span-2">
                                    <a href="{{ asset('storage/' . $chunk[0]->image_url) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $chunk[0]->image_url) }}"
                                            class="w-full h-[420px] object-cover rounded-2xl cursor-pointer">
                                    </a>
                                </div>

                                <div>
                                    <a href="{{ asset('storage/' . $chunk[1]->image_url) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $chunk[1]->image_url) }}"
                                            class="w-full h-[200px] object-cover rounded-2xl cursor-pointer">
                                    </a>
                                </div>

                                <div class="row-span-2">
                                    <a href="{{ asset('storage/' . $chunk[2]->image_url) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $chunk[2]->image_url) }}"
                                            class="w-full h-[420px] object-cover rounded-2xl cursor-pointer">
                                    </a>
                                </div>

                                <div>
                                    <a href="{{ asset('storage/' . $chunk[3]->image_url) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $chunk[3]->image_url) }}"
                                            class="w-full h-[200px] object-cover rounded-2xl cursor-pointer">
                                    </a>
                                </div>

                            </div>
                        @else
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($chunk as $gallery)
                                    <a href="{{ asset('storage/' . $gallery->image_url) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $gallery->image_url) }}"
                                            class="w-full h-[300px] object-cover rounded-2xl cursor-pointer">
                                    </a>
                                @endforeach
                            </div>
                        @endif

                    </div>

                @empty
                    <div class="min-w-full flex items-center justify-center h-60">
                        <p class="text-mediumGrey text-sm">No gallery available.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- ================= REVIEW ================= -->
    <section class="max-w-7xl mx-auto px-6 pb-20">

        <h2 class="text-2xl font-semibold mb-6">Tour Review</h2>

        <!-- Rating summary -->
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-12 mb-8">

            <!-- Rating number + stars -->
            <div class="flex flex-col">
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-medium">{{ $package->rating_avg }}</span>
                    <span class="text-sm text-mediumGrey">{{ $package->reviews->count() }} reviews</span>
                </div>

                <div class="flex gap-1 text-yellow-400 mt-2">
                    @php
                        $fullStars = floor($package->rating_avg); // bintang penuh
                        $halfStar = $package->rating_avg - $fullStars >= 0.5; // ada setengah bintang?
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    {{-- Bintang penuh --}}
                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fa-solid fa-star text-lg"></i>
                    @endfor

                    {{-- Setengah bintang --}}
                    @if ($halfStar)
                        <i class="fa-solid fa-star-half-stroke text-lg"></i>
                    @endif

                    {{-- Bintang kosong --}}
                    @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="fa-regular fa-star text-lg"></i>
                    @endfor
                </div>
            </div>

            <!-- Filters -->
            <div
                class="flex items-center gap-3 overflow-x-auto
    [-ms-overflow-style:none]
    [scrollbar-width:none]
    [&::-webkit-scrollbar]:hidden">
                <a href="{{ route('tours.show', $package->id) }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm 
                    {{ !request('filter') ? 'bg-darkGreen text-white' : 'bg-lightGrey' }}">
                    All ({{ $package->reviews->count() }})
                </a>

                @php
                    $photoCount = $package->reviews->filter(fn($r) => !empty($r->images))->count();
                @endphp

                @if ($photoCount > 0)
                    <a href="{{ route('tours.show', ['package' => $package->id, 'filter' => 'photo']) }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm
        {{ request('filter') === 'photo' ? 'bg-darkGreen text-white' : 'bg-lightGrey' }}">
                        <i class="fa-solid fa-camera text-darkGrey"></i> Photo
                        ({{ $photoCount }})
                    </a>
                @endif

                @for ($i = 5; $i >= 1; $i--)
                    @if (($ratingCounts[$i] ?? 0) > 0)
                        <a href="{{ route('tours.show', ['package' => $package->id, 'filter' => $i]) }}"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm
            {{ request('filter') == $i ? 'bg-darkGreen text-white' : 'bg-lightGrey' }}">
                            {{ $i }} <i class="fa-solid fa-star text-yellow-400"></i>
                            ({{ $ratingCounts[$i] }})
                        </a>
                    @endif
                @endfor
            </div>
        </div>

        <div class="my-12 border-t border-mediumGrey/20"></div>

        <!-- Reviews -->
        <div class="grid grid-cols-1 gap-6">
            <div id="review-container" class="space-y-8">
                @forelse ($reviews as $review)

                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-6 flex flex-col">

                        <!-- Header -->
                        <div class="flex items-center gap-4 mb-4">

                            @if ($review->user?->profile_image)
                                <img src="{{ asset('storage/' . $review->user->profile_image) }}"
                                    class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div
                                    class="w-12 h-12 bg-darkGreen rounded-full flex items-center justify-center text-white">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            @endif

                            <div class="flex-1">
                                <p class="font-semibold mb-1">{{ $review->user->first_name }}
                                    {{ $review->user->last_name }}
                                </p>
                                <p class="text-xs text-mediumGrey">
                                    {{ $review->user->country ?? '' }} •
                                    {{ $review->created_at->format('d F Y') }}
                                </p>
                            </div>

                            <!-- Stars -->
                            <div class="flex gap-1 text-yellow-400 text-sm">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="{{ $i < $review->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                @endfor
                            </div>

                        </div>

                        <!-- Comment -->
                        <p class="text-darkGrey leading-relaxed mb-4">
                            {{ $review->comment }}
                        </p>

                        <!-- Image -->
                        @if (!empty($review->images))
                            <div
                                class="flex gap-6 overflow-x-auto whitespace-nowrap
                pb-2
                [-ms-overflow-style:none]
                [scrollbar-width:none]
                [&::-webkit-scrollbar]:hidden">

                                @foreach ($review->images as $img)
                                    <a href="{{ asset('storage/' . $img) }}" target="_blank"
                                        class="inline-block w-20 h-20 shrink-0 overflow-hidden rounded-xl">

                                        <img src="{{ asset('storage/' . $img) }}"
                                            class="w-full h-full object-cover
                   transition duration-300 hover:scale-110 cursor-pointer">
                                    </a>
                                @endforeach


                            </div>
                        @endif

                    </div>

                @empty
                    <div class="min-w-full flex items-center justify-center h-60">
                        <p class="text-mediumGrey text-sm">No review available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- View more -->
        @if ($reviews->hasMorePages())
            <div class="flex justify-center mt-10">
                <button id="load-more" data-url="{{ $reviews->nextPageUrl() }}"
                    class="text-darkGreen font-medium flex items-center gap-3 mx-auto hover:text-darkGreen/80">
                    View More Reviews
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>
        @endif

    </section>

    <!-- ================= CBF ================= -->

    <section class="max-w-7xl mx-auto px-6 pb-20">

        <h2 class="text-2xl font-semibold mb-6">Similar Experiences</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($similarPackages as $item)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                    <!-- Image -->
                    <div class="relative">
                        <img src="{{ asset('storage/' . $item->image_url) }}" class="w-full h-[220px] object-cover">

                        <span class="absolute top-6 left-6 bg-darkGreen text-white text-xs px-3 py-2 rounded-full">
                            {{ app()->getLocale() === 'id' ? $item->category->name_id : $item->category->name_en }}

                        </span>
                    </div>

                    <!-- Content -->
                    <div class="p-6">

                        <p class="text-sm text-darkGrey mb-2">
                            {{ app()->getLocale() === 'id' ? $item->type->name_id : $item->type->name_en }}

                        </p>

                        <h3 class="font-semibold text-lg mb-2">
                            {{ app()->getLocale() === 'id' ? $item->name_id : $item->name_en }}
                        </h3>

                        @php
                            $rating = round($item->reviews_avg_rating ?? 0, 1);
                            $fullStars = floor($rating);
                            $halfStar = $rating - $fullStars >= 0.5;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp

                        <!-- Rating -->
                        <div class="flex items-center gap-1 text-sm mb-3">
                            <div class="flex items-center text-yellow-400">

                                {{-- Full stars --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor

                                {{-- Half star --}}
                                @if ($halfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif

                                {{-- Empty stars --}}
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star"></i>
                                @endfor

                            </div>

                            <span class="font-medium ml-1">{{ $rating }}</span>
                            <span class="text-darkGrey">({{ $item->reviews_count }} reviews)</span>
                        </div>

                        {{-- DEBUG SCORE (hapus nanti) --}}
                        <p class="text-xs text-gray-400 mb-2">
                            similarity: {{ number_format($item->similarity_score, 3) }}
                        </p>

                        <p class="text-sm text-darkGrey mb-4 line-clamp-2">
                            {{ app()->getLocale() === 'id' ? $item->overview_id : $item->overview_en }}
                        </p>

                        <!-- Meta -->
                        <div class="flex items-center justify-between text-xs font-medium text-darkGreen mb-5">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock"></i>
                                <span>
                                    {{ $item->duration }} {{ $item->duration > 1 ? 'days' : 'day' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-friends"></i>
                                <span>{{ $item->guest_min }}–{{ $item->guest_max }} guests</span>
                            </div>
                        </div>

                        <div class="border-t border-lightGrey my-5"></div>

                        <!-- Price -->
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col justify-center">
                                <p class="text-xs text-darkGrey mb-1">Starting from</p>
                                <p class="font-semibold">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <a href="{{ route('tours.show', $item->id) }}"
                                class="bg-darkGreen text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 self-center">
                                Read More
                                <i class="fas fa-angle-double-right text-xs"></i>
                            </a>
                        </div>

                    </div>

                </div>

            @empty
                <div class="min-w-full flex items-center justify-center h-60">
                    <p class="text-mediumGrey text-sm">No similar package found.</p>
                </div>
            @endforelse

        </div>

    </section>

@endsection

@push('scripts')
    <script>
        const wrapper = document.getElementById('galleryWrapper');
        const totalSlides = wrapper.children.length;
        let currentSlide = 0;

        function updateSlide() {
            wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        document.getElementById('nextBtn')?.addEventListener('click', () => {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlide();
            }
        });

        document.getElementById('prevBtn')?.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlide();
            }
        });

        // load review
        document.getElementById('load-more')?.addEventListener('click', function() {

            let btn = this;
            let url = btn.dataset.url;

            btn.innerText = "Loading...";

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    let html = '';

                    data.reviews.forEach(review => {

                        // ⭐ Avatar
                        let avatar = review.user?.profile_image ?
                            `<img src="/storage/${review.user.profile_image}"
                        class="w-12 h-12 rounded-full object-cover">` :
                            `<div class="w-12 h-12 bg-darkGreen rounded-full flex items-center justify-center text-white">
                        <i class="fa-solid fa-user"></i>
                   </div>`;

                        // ⭐ Stars
                        let stars = '';
                        for (let i = 0; i < 5; i++) {
                            stars +=
                                `<i class="${i < review.rating ? 'fa-solid' : 'fa-regular'} fa-star"></i>`;
                        }

                        // ⭐ Images
                        let images = '';

                        if (review.images && review.images.length) {

                            let imgs = '';

                            review.images.forEach(img => {
                                imgs += `
        <a href="/storage/${img}" target="_blank"
           class="inline-block w-20 h-20 shrink-0 overflow-hidden rounded-xl">
           
            <img src="/storage/${img}"
                class="w-full h-full object-cover
                       transition duration-300 hover:scale-110 cursor-pointer">
        </a>
    `;
                            });

                            images = `
                    <div class="flex gap-3 overflow-x-auto whitespace-nowrap
                        pb-2
                        [-ms-overflow-style:none]
                        [scrollbar-width:none]
                        [&::-webkit-scrollbar]:hidden">
                        ${imgs}
                    </div>
                `;
                        }

                        // ⭐ Date format
                        let date = new Date(review.created_at)
                            .toLocaleDateString('en-GB', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });

                        html += `
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-6 flex flex-col">

                    <div class="flex items-center gap-4 mb-4">

                        ${avatar}

                        <div class="flex-1">
                            <p class="font-semibold mb-1">
                                ${review.user?.first_name ?? ''} ${review.user?.last_name ?? ''}
                            </p>

                            <p class="text-xs text-mediumGrey">
                                ${review.user?.country ?? ''} • ${date}
                            </p>
                        </div>

                        <div class="flex gap-1 text-yellow-400 text-sm">
                            ${stars}
                        </div>

                    </div>

                    <p class="text-darkGrey leading-relaxed mb-4">
                        ${review.comment}
                    </p>

                    ${images}

                </div>
            `;
                    });

                    document
                        .getElementById('review-container')
                        .insertAdjacentHTML('beforeend', html);

                    if (data.next_page) {
                        btn.dataset.url = data.next_page;
                        btn.innerText = "Load More";
                    } else {
                        btn.remove();
                    }

                });

        });
    </script>
@endpush
