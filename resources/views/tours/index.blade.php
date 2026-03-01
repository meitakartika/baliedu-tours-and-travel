@extends('layout.app')

@section('title', app()->getLocale() === 'id' ? $category->name_id : $category->name_en)

@section('content')

    <!-- ================= HERO TOURS ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        @php
            $heroTypeId = $category->id ?? 1;
        @endphp

        <img src="/images/tours{{ $heroTypeId }}-hero.png" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-lightGreen text-3xl md:text-4xl font-semibold">
            {{ app()->getLocale() === 'id' ? $category->name_id : $category->name_en }}
        </h1>
    </section>

    <!-- ================= TOURS CONTENT ================= -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- ===== SEARCH BAR ===== -->
            <form method="GET" action="{{ route('tours.category', $category->id) }}" class="mb-8 relative">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari paket wisata..."
                    class="w-full rounded-full border border-mediumGrey/30
                   py-4 pl-6 pr-12 text-sm
                   focus:outline-none focus:ring-1 focus:ring-darkGreen" />

                <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-mediumGrey">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <!-- ===== Filter & Sort ===== -->
            <form action="{{ route('tours.category', $category) }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 w-full">
                <!-- Filter -->
                <div class="relative w-full">
                    <label class="flex items-center gap-2 text-sm font-medium text-darkGrey mb-3 ml-1">
                        <i class="fas fa-filter text-darkGrey"></i>
                        <span>Filter by type of tour</span>
                    </label>

                    <div class="relative w-full">
                        <select name="type" onchange="this.form.submit()"
                            class="w-full border border-mediumGrey/30 rounded-full px-5 pr-12 py-3 text-sm
                       focus:outline-none focus:ring-1 focus:ring-darkGreen appearance-none h-12">
                            <option value="">All Types</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() === 'id' ? $type->name_id : $type->name_en }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-darkGrey"></i>
                        </div>
                    </div>
                </div>

                <!-- Sort -->
                <div class="relative w-full">
                    <label class="flex items-center gap-2 text-sm font-medium text-darkGrey mb-3 ml-1">
                        <i class="fas fa-sort-amount-down-alt text-darkGrey"></i>
                        <span>Sort by</span>
                    </label>

                    <div class="relative w-full">
                        <select name="sort" onchange="this.form.submit()"
                            class="w-full border border-mediumGrey/30 rounded-full px-5 pr-12 py-3 text-sm
                       focus:outline-none focus:ring-1 focus:ring-darkGreen appearance-none h-12">
                            <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest
                            </option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="highest" {{ request('sort') === 'highest' ? 'selected' : '' }}>Highest Rated
                            </option>
                            <option value="lowest" {{ request('sort') === 'lowest' ? 'selected' : '' }}>Lowest Rated
                            </option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-darkGrey"></i>
                        </div>
                    </div>
                </div>
            </form>

            <!-- ===== TOUR CARDS ===== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

                <!-- CARD -->
                @forelse ($packages as $package)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                        <!-- Image -->
                        <div class="relative">
                            <img src="{{ asset('storage/' . $package->image_url) }}" class="w-full h-[220px] object-cover"
                                alt="">
                            <span class="absolute top-6 left-6 bg-darkGreen text-white text-xs px-3 py-2 rounded-full">
                                {{ app()->getLocale() === 'id' ? $category->name_id : $category->name_en }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-6">

                            <p class="text-sm text-darkGrey mb-2">
                                {{ app()->getLocale() === 'id' ? $package->type->name_id : $package->type->name_en }}
                            </p>

                            <h3 class="font-semibold text-lg mb-2">
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
                                <span class="text-darkGrey">({{ $package->reviews_count }} reviews)</span>
                            </div>

                            <p class="text-sm text-darkGrey mb-4 line-clamp-2">
                                {{ app()->getLocale() === 'id' ? $package->overview_id : $package->overview_en }}
                            </p>

                            <!-- Meta -->
                            <div class="flex items-center justify-between text-xs font-medium text-darkGreen mb-5">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock"></i>
                                    <span>
                                        {{ $package->duration }} {{ $package->duration > 1 ? 'days' : 'day' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-friends"></i>
                                    <span>{{ $package->guest_min }}–{{ $package->guest_max }} guests</span>
                                </div>
                            </div>

                            <div class="border-t border-lightGrey my-5"></div>

                            <!-- Price -->
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col justify-center">
                                    <p class="text-xs text-darkGrey mb-1">Starting from</p>
                                    <p class="font-semibold">
                                        Rp{{ number_format($package->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <a href="{{ route('tours.show', ['package' => $package->id]) }}"
                                    class="bg-darkGreen text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 self-center">
                                    Read More
                                    <i class="fas fa-angle-double-right text-xs"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-span-3 flex flex-col items-center justify-center py-20 text-center">

                        <img src="{{ asset('images/empty.png') }}" alt="Empty Tour" class="w-48 md:w-32 mb-8">

                        <h3 class="text-lg font-semibold text-darkGrey mb-2">
                            Tidak ada paket wisata
                        </h3>

                        <p class="text-sm text-mediumGrey max-w-md">
                            Coba kata kunci lain atau kembali lagi nanti.
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
@endpush
