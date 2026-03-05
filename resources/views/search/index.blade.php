@extends('layout.app')

@section('title', __('search.title'))

@section('content')

    <!-- ================= HERO SEARCH ================= -->
    <section class="relative h-[480px] md:h-[520px]">

        <!-- Background Image -->
        <img src="/images/search-hero.png" alt="Search Hero" class="absolute inset-0 w-full h-full object-cover">

        <div class="relative z-10 h-full flex flex-col items-center justify-center px-6">

            <!-- Title -->
            <h1 class="text-lightGreen text-3xl md:text-4xl font-semibold mb-2 md:mb-10">
                {{ __('search.hero_title_1') }} <span class="text-white">{{ __('search.hero_title_2') }} </span>
            </h1>

            <!-- Search Box -->
            <form action="{{ route('search') }}" method="GET"
                class="mt-10 bg-lightGrey/60 backdrop-blur-md rounded-l p-4 md:p-6 
                        flex flex-col md:flex-row items-stretch md:items-center
                        gap-4 md:gap-0 max-w-4xl mx-auto">

                <!-- Location -->
                <div class="flex items-center gap-5 px-4 lg:border-r lg:border-white">
                    <i class="fa-solid fa-location-dot text-white text-2xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">{{ __('search.location') }} </p>
                        <input type="text" name="location" value="{{ request('location') }}"
                            placeholder="{{ __('search.location_placeholder') }} "
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Duration -->
                <div class="flex items-center gap-5 px-4 lg:pl-12 lg:border-r md:border-white"> <i
                        class="fa-solid fa-clock text-white text-2xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">{{ __('search.duration') }} </p> <input type="number"
                            name="duration" value="{{ request('duration') }}"
                            placeholder="{{ __('search.duration_placeholder') }} "
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Guests -->
                <div class="flex items-center gap-5 px-4 lg:pl-12">
                    <i class="fa-solid fa-user-group text-white text-xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">{{ __('search.guests') }} </p>
                        <input type="number" name="guests" value="{{ request('guests') }}"
                            placeholder="{{ __('search.guests_placeholder') }} "
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="bg-darkGreen hover:bg-darkGreen/90 transition
                       text-white rounded-lg
                       w-full md:w-14 h-12 flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

    </section>

    <!-- ================= TOURS CONTENT ================= -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- SECTION TITLE -->
            <div class="mb-10">
                <h2 class="text-xl md:text-2xl font-semibold text-black">
                    {{ __('search.results_title') }}
                </h2>
            </div>

            <!-- ===== TOUR CARDS ===== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

                <!-- CARD -->
                @forelse($packages as $package)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full">

                        <!-- Image -->
                        <div class="relative">
                            <img src="{{ asset('storage/' . $package->image_url) }}" class="w-full h-[220px] object-cover">
                            <span class="absolute top-6 left-6 bg-darkGreen text-white text-xs px-3 py-2 rounded-full">
                                {{ app()->getLocale() === 'id' ? $package->category->name_id : $package->category->name_en }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-1">

                            <p class="text-sm text-darkGrey mb-2">
                                {{ app()->getLocale() === 'id' ? $package->type->name_id : $package->type->name_en }}
                            </p>

                            <h3 class="tour-title font-semibold text-lg mb-2 line-clamp-2">
                                {{ app()->getLocale() === 'id' ? $package->name_id : $package->name_en }}
                            </h3>

                            @php
                                $rating = round($package->reviews_avg_rating ?? 0, 1);
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
                                <span class="text-darkGrey">({{ $package->reviews_count }} {{ __('search.reviews') }}
                                    )</span>
                            </div>

                            <p class="tour-overview text-sm text-darkGrey mb-4 line-clamp-2">
                                {{ app()->getLocale() === 'id' ? $package->overview_id : $package->overview_en }}
                            </p>

                            <!-- Meta -->
                            <div class="flex items-center justify-between text-xs font-medium text-darkGreen mb-5">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock"></i>
                                    <span>
                                        {{ $package->duration }}
                                        {{ $package->duration > 1 ? __('search.day_2') : __('search.day_1') }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-friends"></i>
                                    <span>{{ $package->guest_min }}–{{ $package->guest_max }}
                                        {{ __('search.guests_label') }} </span>
                                </div>
                            </div>

                            <div class="border-t border-lightGrey mb-5"></div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex flex-col justify-center">
                                    <p class="text-xs text-darkGrey mb-1">{{ __('search.starting_from') }}</p>
                                    <p class="font-semibold">
                                        Rp{{ number_format($package->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <a href="{{ route('tours.show', ['package' => $package->id]) }}"
                                    class="bg-darkGreen text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 self-center hover:bg-darkGreen/90 transition">
                                    {{ __('search.read_more') }}
                                    <i class="fas fa-angle-double-right text-xs"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-span-3 flex flex-col items-center justify-center py-20 text-center">

                        <img src="{{ asset('images/empty.png') }}" alt="Empty Tour" class="w-48 md:w-32 mb-8">

                        <h3 class="text-lg font-semibold text-darkGrey mb-2">
                            {{ __('search.empty_title') }}
                        </h3>

                        <p class="text-sm text-mediumGrey max-w-md">
                            {{ __('search.empty_desc') }}
                        </p>

                    </div>
                @endforelse
            </div>

            <!-- ===== Pagination ===== -->
            {{ $packages->withQueryString()->links('vendor.pagination') }}
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".tour-title").forEach(function(title) {
                const overview = title.closest(".p-6").querySelector(".tour-overview");

                if (!overview) return;

                // kalau tinggi judul lebih kecil dari 2 baris
                const lineHeight = parseFloat(getComputedStyle(title).lineHeight);
                const isOneLine = title.offsetHeight <= lineHeight * 1.5;

                if (isOneLine) {
                    overview.classList.remove("line-clamp-2");
                    overview.classList.add("line-clamp-3");
                }
            });
        });
    </script>
@endpush
