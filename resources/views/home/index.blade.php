@extends('layout.app')

@section('title', __('home.title'))

<style>
    @keyframes blobFloat {

        0%,
        100% {
            transform: translateY(-6px) scale(1);
        }

        50% {
            transform: translateY(18px) scale(1.05);
        }
    }

    .blob-animate {
        animation: blobFloat 6.5s ease-in-out infinite;
    }

    /* Transisi halus untuk pergerakan kartu */
    .testimonial-card {
        transition: all 0.6s ease;
    }

    /* CARD DEPAN */
    .testimonial-card:nth-child(1) {
        transform: translateX(0) scale(1);
        z-index: 3;
    }

    /* CARD TENGAH */
    .testimonial-card:nth-child(2) {
        transform: translateX(25px) scale(0.95);
        z-index: 2;
        opacity: 0.9;
    }

    /* CARD BELAKANG */
    .testimonial-card:nth-child(3) {
        transform: translateX(50px) scale(0.9);
        z-index: 1;
        opacity: 0.8;
    }
</style>

@section('content')
    <!-- ================= HERO HOME ================= -->
    <section class="relative min-h-screen flex items-center">

        <!-- Background Image -->
        <div class="absolute inset-0 bg-darkGreen">
            @if (!empty($heroSlides->images))
                <img id="hero-background" src="{{ asset('storage/' . $heroSlides->images[0]) }}" alt="Hero Background"
                    class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6">

            <!-- Text -->
            <div class="max-w-4xl mx-auto text-white">
                <div class="max-w-2xl text-left">

                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold
                   leading-relaxed md:leading-snug lg:leading-normal">
                        {!! nl2br(
                            e(app()->getLocale() === 'en' ? $heroSlides->description_en ?? '' : $heroSlides->description_id ?? ''),
                        ) !!}
                    </h1>
                </div>
            </div>

            <!-- Search Box -->
            <form action="{{ route('search') }}" method="GET"
                class="mt-10 bg-lightGrey/60 backdrop-blur-md rounded-l p-4 md:p-6 
                        flex flex-col md:flex-row items-stretch md:items-center
                        gap-4 md:gap-0 max-w-4xl mx-auto">

                <!-- Location -->
                <div class="flex items-center gap-5 px-4 lg:border-r lg:border-white">
                    <i class="fa-solid fa-location-dot text-white text-2xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">{{ __('home.location') }}</p>
                        <input type="text" name="location" placeholder="{{ __('home.location_placeholder') }}"
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Duration -->
                <div class="flex items-center gap-5 px-4 lg:pl-12 lg:border-r md:border-white"> <i
                        class="fa-solid fa-clock text-white text-2xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">{{ __('home.duration') }}</p> <input type="number"
                            name="duration" placeholder="{{ __('home.duration_placeholder') }}"
                            class="mt-1 bg-transparent text-white placeholder-white/80 text-sm outline-none w-full">
                    </div>
                </div>

                <!-- Guests -->
                <div class="flex items-center gap-5 px-4 lg:pl-12">
                    <i class="fa-solid fa-user-group text-white text-xl"></i>
                    <div>
                        <p class="text-white text-sm font-medium">{{ __('home.guests') }}</p>
                        <input type="number" name="guests" placeholder="{{ __('home.guests_placeholder') }}"
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

        <!-- Hero Slide Indicators -->
        <div id="hero-indicators" class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2 z-20">
            @foreach ($heroSlides->images ?? [] as $index => $image)
                <button type="button"
                    class="hero-indicator w-2.5 h-2.5 rounded-full transition-all duration-300
                {{ $index === 0 ? 'bg-white scale-125' : 'bg-white/50' }}"
                    aria-label="Slide {{ $index + 1 }}" onclick="changeHeroSlide({{ $index }})">
                </button>
            @endforeach
        </div>
    </section>

    <!-- ================= CATEGORY ================= -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-red font-semibold tracking-widest mb-6">
                    {{ __('home.category_label') }}
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    {{ __('home.category_title') }}
                </h2>

                <p class="text-darkGrey leading-relaxed">
                    {{ __('home.category_desc') }}
                </p>
            </div>

            <!-- Cards -->
            <div
                class="grid grid-flow-col auto-cols-[280px] gap-8 overflow-x-auto pb-4
            [scrollbar-width:none] [-ms-overflow-style:none]
            [&::-webkit-scrollbar]:hidden">

                @foreach ($categories as $index => $category)
                    <div class="relative h-[380px] rounded-2xl overflow-hidden group bg-darkGreen">
                        <img src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-500">

                        <div class="relative z-10 p-6 pb-8 h-full flex flex-col justify-end text-white">
                            <h3 class="text-xl font-semibold mb-2">
                                {{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}
                            </h3>
                            <p class="text-sm text-white/90 mb-4">
                                {{ app()->getLocale() == 'id' ? $category->description_id : $category->description_en }}
                            </p>

                            <a href="{{ route('tours.category', $category->id) }}"
                                class="flex items-center gap-2 text-lightGreen font-medium hover:text-lightGreen/80 transition">
                                {{ __('home.see_activities') }}
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- ================= STATISTICS ================= -->
    <section class="relative py-24 bg-lightGrey overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <!-- LEFT CONTENT -->
                <div class="relative max-w-lg">

                    <!-- TEXT CONTENT -->
                    <p class="text-red font-semibold tracking-widest mb-6">
                        {{ __('home.statistics_label') }}
                    </p>

                    <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                        {{ __('home.statistics_title') }}
                    </h2>

                    <p class="text-darkGrey leading-relaxed max-w-lg">
                        {{ __('home.statistics_desc') }}
                    </p>

                    <!-- DECORATIVE ICONS -->
                    <div
                        class="absolute
           -top-6
           right-16
           md:right-32
           bg-lightGreen w-12 h-12 rounded-full
           flex items-center justify-center shadow-md
           transition-all duration-300 hover:-translate-y-2 hover:rotate-6">
                        <i class="fa-solid fa-paper-plane fa-flip-horizontal text-white"></i>
                    </div>

                    <div
                        class="absolute
           -bottom-16
           md:-bottom-20
           left-6
           md:left-10
           bg-lightGreen w-12 h-12 rounded-full
           flex items-center justify-center shadow-md
           transition-all duration-300 hover:-translate-y-2 hover:rotate-6">
                        <i class="fa-solid fa-location-dot text-white"></i>
                    </div>

                </div>

                <!-- RIGHT CONTENT -->
                <div class="relative">

                    <!-- BLOB IMAGE -->
                    <img src="{{ asset('images/icons/blob.svg') }}" alt="blob"
                        class="absolute
            -right-6 -bottom-2
            sm:right-4 sm:-top-12
            md:right-4 md:-top-16
            w-[520px] h-[520px]
            sm:w-[420px] sm:h-[420px]
            md:w-[460px] md:h-[460px]
            object-contain
            z-0 pointer-events-none blob-animate">

                    <!-- CARDS -->
                    <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <i class="fa-solid fa-chart-line text-darkGreen text-3xl mb-4"></i>
                            <h3 class="text-3xl font-bold text-darkGreen">{{ __('home.number_1') }}</h3>
                            <p class="text-sm text-darkGrey mt-2">{{ __('home.years_experience') }}</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg p-6 text-center sm:translate-y-16">
                            <i class="fa-solid fa-map text-darkGreen text-3xl mb-4"></i>
                            <h3 class="text-3xl font-bold text-darkGreen">{{ __('home.number_2') }}</h3>
                            <p class="text-sm text-darkGrey mt-2">{{ __('home.amazing_tours') }}</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <i class="fa-solid fa-star text-darkGreen text-3xl mb-4"></i>
                            <h3 class="text-3xl font-bold text-darkGreen">{{ __('home.number_3') }}</h3>
                            <p class="text-sm text-darkGrey mt-2">{{ __('home.happy_customer') }}</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= DISCOVER ================= -->
    <section class="py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

                <!-- LEFT IMAGES -->
                <div class="relative flex justify-start">

                    <!-- BIG OVAL IMAGE -->
                    <div
                        class="w-[300px] md:w-[350px] h-[520px] 
            rounded-full overflow-hidden 
            border-8 border-white shadow-xl">
                        <img src="/images/discover-main.png" alt="Bali" class="w-full h-full object-cover">
                    </div>

                    <!-- SMALL OVAL IMAGE -->
                    <div
                        class="absolute -bottom-8
         right-1/2 translate-x-24
         md:translate-x-40
         lg:translate-x-72
         w-[200px] h-[300px]
         rounded-full overflow-hidden
         border-8 border-white shadow-lg">
                        <img src="/images/discover-small.png" alt="Bali" class="w-full h-full object-cover">
                    </div>

                    <!-- 3D ILLUSTRATION -->
                    <img src="/images/illustration-travel.png" alt="Travel"
                        class="absolute top-32 right-1/2 translate-x-24
         md:translate-x-40
          lg:translate-x-72
            w-36 md:w-44 
            -translate-y-1/2">
                </div>

                <!-- RIGHT CONTENT -->
                <div class="max-w-xl">

                    <p class="text-red font-semibold tracking-widest mb-6">
                        {{ __('home.discover_label') }}
                    </p>

                    <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                        {{ __('home.discover_title') }}
                    </h2>

                    <p class="text-darkGrey leading-relaxed mb-10">
                        {{ __('home.discover_desc') }}
                    </p>

                    <a href="{{ route('about') }}"
                        class="inline-flex items-center gap-3 bg-darkGreen
                          text-white px-8 py-4 rounded-lg font-medium
                          hover:bg-darkGreen/90 transition">
                        {{ __('home.learn_more') }}
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>
    </section>

    <!-- ================= TESTIMONIALS ================= -->
    <section class="relative py-24 overflow-hidden">
        <!-- BACKGROUND GRADIENT -->
        <div class="absolute inset-0">
            <img src="/images/testimonial-bg.png" alt="Background" class="w-full h-full object-cover">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 items-center">

            <!-- LEFT CONTENT -->
            <div class="text-white">
                <p class="text-lightGreen font-semibold tracking-widest mb-6">
                    {{ __('home.testimonial_label') }}
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold leading-tight mb-12">
                    <span class="block">{{ __('home.testimonial_title_1') }}</span>
                    <span class="block mt-3 md:mt-4">{{ __('home.testimonial_title_2') }}</span>
                </h2>

                <div class="flex gap-16">
                    <div>
                        <p class="text-3xl font-semibold flex items-center gap-2">
                            {{ __('home.rating_number') }}
                            <span>★</span>
                        </p>
                        <p class="text-sm opacity-90 mt-2">
                            {{ __('home.reviews_text') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-3xl font-semibold">
                            {{ __('home.number_3') }}
                        </p>
                        <p class="text-sm opacity-90 mt-2">
                            {{ __('home.happy_travelers') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="relative w-full max-w-xl h-[360px] overflow-visible mt-12 lg:mt-0" id="testimonial-stack">

                <!-- CARD 1 -->
                <div class="testimonial-card absolute w-full bg-white rounded-3xl p-8 shadow-xl cursor-pointer">
                    <!-- Quote Icon -->
                    <span
                        class="absolute top-8 right-8 text-[80px] font-serif font-bold 
        text-gray-200 leading-none select-none pointer-events-none">
                        “
                    </span>

                    <p class="text-lg text-darkGreen mb-8 mt-2">{{ __('home.cultural_title') }}</p>

                    <p class="text-darkGrey font-medium mb-8">
                        {{ __('home.cultural_text') }}
                    </p>

                    <!-- Divider -->
                    <div class="border-t border-lightGrey pt-6 flex items-center gap-3">
                        <img src="/images/avatar1.png" class="w-14 h-14 rounded-full">
                        <div>
                            <p class="font-medium text-md mb-1">{{ __('home.cultural_name') }}</p>
                            <p class="text-sm text-darkGrey">{{ __('home.cultural_country') }}</p>
                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="testimonial-card absolute w-full bg-white rounded-3xl p-8 shadow-xl cursor-pointer">
                    <!-- Quote Icon -->
                    <span
                        class="absolute top-8 right-8 text-[80px] font-serif font-bold 
        text-gray-200 leading-none select-none pointer-events-none">
                        “
                    </span>

                    <p class="text-lg text-darkGreen mb-8 mt-2">{{ __('home.adventure_title') }}</p>

                    <p class="text-darkGrey font-medium mb-8">
                        {{ __('home.adventure_text') }}
                    </p>

                    <!-- Divider -->
                    <div class="border-t border-lightGrey pt-6 flex items-center gap-3">
                        <img src="/images/avatar2.png" class="w-14 h-14 rounded-full">
                        <div>
                            <p class="font-medium text-md mb-1">{{ __('home.adventure_name') }}</p>
                            <p class="text-sm text-darkGrey">{{ __('home.adventure_country') }}</p>
                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="testimonial-card absolute w-full bg-white rounded-3xl p-8 shadow-xl cursor-pointer">
                    <!-- Quote Icon -->
                    <span
                        class="absolute top-6 right-8 text-[80px] font-serif font-bold 
        text-gray-200 leading-none select-none pointer-events-none">
                        “
                    </span>

                    <p class="text-lg text-darkGreen mb-8 mt-2">{{ __('home.romantic_title') }}</p>

                    <p class="text-darkGrey font-medium mb-8">
                        {{ __('home.romantic_text') }}
                    </p>

                    <!-- Divider -->
                    <div class="border-t border-lightGrey pt-6 flex items-center gap-3">
                        <img src="/images/avatar3.png" class="w-14 h-14 rounded-full">
                        <div>
                            <p class="font-medium text-md mb-1">{{ __('home.romantic_name') }}</p>
                            <p class="text-sm text-darkGrey">{{ __('home.romantic_country') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= GALLERY ================= -->
    <section class="py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <!-- HEADER -->
            <div class="flex flex-col lg:flex-row lg:justify-between gap-8 mb-14">

                <div class="max-w-xl">
                    <p class="text-red font-semibold tracking-widest mb-6">
                        {{ __('home.gallery_label') }}
                    </p>

                    <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                        {{ __('home.gallery_title') }}
                    </h2>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('home.gallery_desc') }}
                    </p>
                </div>

                <div class="flex lg:items-end">
                    <a href="{{ route('gallery') }}" type="button"
                        class="inline-flex items-center justify-center
                   bg-darkGreen text-white
                   px-8 py-4 rounded-lg font-medium
                   hover:bg-darkGreen/90 transition">
                        {{ __('home.view_all') }}
                    </a>
                </div>
            </div>

            <!-- GALLERY GRID -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($galleries as $gallery)
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image_url) }}"
                            class="w-full h-full object-cover hover:scale-110 transition duration-500"
                            alt="{{ __('home.gallery_title') }}">
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ================= FAQ ================= -->
    <section class="relative py-24 overflow-hidden">

        <!-- BACKGROUND IMAGE -->
        <img src="/images/faq-bg.png" alt="FAQ Background"
            class="absolute inset-0 w-full h-full object-cover pointer-events-none" />

        <!-- CONTENT -->
        <div class="relative max-w-4xl mx-auto px-6">

            <!-- TITLE -->
            <div class="text-center mb-16">
                <p class="text-red font-semibold tracking-widest mb-6">{{ __('home.faq_label') }}</p>
                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen">
                    {{ __('home.faq_title') }}
                </h2>
            </div>

            <!-- FAQ LIST -->
            <div class="space-y-4">

                <!-- ITEM 1 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            {{ __('home.q1') }}
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        {{ __('home.a1') }}
                    </p>
                </div>

                <!-- ITEM 2 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            {{ __('home.q2') }}
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        {{ __('home.a2') }}
                    </p>
                </div>

                <!-- ITEM 3 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            {{ __('home.q3') }}
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        {{ __('home.a3') }}
                    </p>
                </div>

                <!-- ITEM 4 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            {{ __('home.q4') }}
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        {{ __('home.a4') }}
                    </p>
                </div>

                <!-- ITEM 5 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            {{ __('home.q5') }}
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        {{ __('home.a5') }}
                    </p>
                </div>

                <!-- ITEM 6 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            {{ __('home.q6') }}
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        {{ __('home.a6') }}
                    </p>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // HERO SLIDESHOW
        const heroImages = @json(collect($heroSlides->images ?? [])->map(fn($image) => asset('storage/' . $image))->values());

        const heroBackground = document.getElementById('hero-background');
        const heroIndicators = document.querySelectorAll('.hero-indicator');

        let currentIndex = 0;

        function changeHeroSlide(index) {
            if (!heroBackground || heroImages.length === 0) return;

            currentIndex = index;
            heroBackground.src = heroImages[currentIndex];

            heroIndicators.forEach((dot, i) => {
                dot.classList.toggle('bg-white', i === currentIndex);
                dot.classList.toggle('bg-white/50', i !== currentIndex);
                dot.classList.toggle('scale-125', i === currentIndex);
            });
        }

        if (heroImages.length > 1) {
            setInterval(() => {
                changeHeroSlide((currentIndex + 1) % heroImages.length);
            }, 5000);
        }

        //TESTIMONIALS
        const stack = document.getElementById("testimonial-stack");

        stack.addEventListener("click", function() {

            const cards = stack.querySelectorAll(".testimonial-card");

            // ambil card pertama
            const firstCard = cards[0];

            // pindahkan ke belakang
            stack.appendChild(firstCard);
        });

        //FAQ
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.faq-btn').forEach(btn => {
                btn.addEventListener('click', () => {

                    const item = btn.closest('.faq-item');
                    const content = item.querySelector('.faq-content');
                    const icon = btn.querySelector('span:last-child');
                    const title = item.querySelector('.faq-title');

                    const isOpen = !content.classList.contains('hidden');

                    // RESET semua
                    document.querySelectorAll('.faq-item').forEach(i => {
                        i.classList.remove(
                            'bg-gradient-to-b',
                            'from-white/10',
                            'to-[#D0E497]/50'
                        );

                        i.querySelector('.faq-content')?.classList.add('hidden');
                        i.querySelector('.faq-btn span:last-child').textContent = '+';

                        const t = i.querySelector('.faq-title');
                        t?.classList.remove('text-darkGreen');
                        t?.classList.add('text-darkGrey');
                    });

                    // BUKA yg diklik
                    if (!isOpen) {
                        content.classList.remove('hidden');
                        icon.textContent = '×';

                        item.classList.add(
                            'bg-gradient-to-b',
                            'from-white/10',
                            'to-[#D0E497]/50'
                        );

                        title.classList.replace('text-darkGrey', 'text-darkGreen');
                    }
                });
            });

        });
    </script>
@endpush
