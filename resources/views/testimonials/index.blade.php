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
                    <p class="text-3xl md:text-4xl font-semibold text-black/90">{{ number_format($averageRating, 1) }}</p>
                    <div class="flex justify-center gap-1 mt-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="fas fa-star {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-mediumGrey/30' }}"></i>
                        @endfor
                    </div>
                    <p class="text-sm font-medium text-darkGrey mt-3">Average Rating</p>
                </div>

                <!-- Divider -->
                <div class="hidden md:block w-px h-24 bg-mediumGrey"></div>

                <!-- Total Reviews -->
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-semibold text-black/90">{{ $totalReviews }}</p>
                    <p class="text-sm font-medium text-darkGrey mt-3">Traveler Reviews</p>
                </div>
            </div>

            <!-- ===== Filter & Sort ===== -->
            <form action="{{ route('testimonials') }}" method="GET"
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

            <!-- ===== Reviews List ===== -->
            <h3 class="text-xl font-semibold text-black/90 mt-8 mb-7">
                All Reviews
            </h3>

            <div class="space-y-10">

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($reviews as $review)
                        <div
                            class="bg-softGrey rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition p-6 flex flex-col">

                            <!-- TOUR + QUOTE -->
                            <div class="flex justify-between items-center mb-2">

                                <!-- Tour -->
                                <p class="text-xs font-semibold text-darkGreen">
                                    {{ app()->getLocale() === 'id' ? $review->package->name_id : $review->package->name_en }}
                                </p>

                                <!-- Quote Icon -->
                                <i class="fas fa-quote-right text-3xl text-darkGreen/10"></i>

                            </div>

                            <!-- Stars -->
                            <div class="flex gap-1 mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-mediumGrey' }} text-xs"></i>
                                @endfor
                            </div>

                            <!-- Review -->
                            <p class="text-sm text-darkGrey leading-relaxed mb-6 line-clamp-4">
                                {{ $review->comment }}
                            </p>

                            <!-- 🔥 CONDITIONAL IMAGES -->
                            @if (!empty($review->images))
                                <div
                                    class="overflow-x-auto pb-2 mb-5 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden whitespace-nowrap">
                                    @foreach ($review->images as $img)
                                        <a href="{{ asset('storage/' . $img) }}" target="_blank"
                                            class="inline-block w-32 h-24 mr-3">
                                            <img src="{{ asset('storage/' . $img) }}"
                                                class="w-full h-full object-cover rounded-lg transition-transform duration-300 ease-in-out hover:scale-110 cursor-pointer">
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <!-- User -->
                            <div class="flex items-center gap-3 mt-auto border-t pt-4">
                                @if ($review->user?->profile_image)
                                    <img src="{{ asset('storage/' . $review->user->profile_image) }}"
                                        class="w-11 h-11 rounded-full object-cover">
                                @else
                                    <div
                                        class="w-11 h-11 rounded-full bg-darkGreen flex items-center justify-center text-white">
                                        <i class="fas fa-user text-sm"></i>
                                    </div>
                                @endif

                                <div>
                                    <p class="font-semibold text-sm">{{ $review->user->first_name }}
                                        {{ $review->user->last_name }}</p>
                                    <p class="text-xs text-darkGrey">{{ $review->user->country }} •
                                        {{ $review->created_at->format('d F Y') }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- ===== Pagination ===== -->
                {{ $reviews->withQueryString()->links('vendor.pagination') }}

            </div>
    </section>

@endsection

@push('scripts')
@endpush
