@extends('layout.app')

@section('title', 'Gallery')

@section('content')

    <!-- ================= HERO TESTIMONIALS ================= -->
    <section class="relative h-[380px] md:h-[420px]">

        <!-- Background Image -->
        <img src="/images/gallery-hero.png" alt="Testimonials Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- CONTENT WRAPPER -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 h-full">

            <!-- Back -->
            <a href="{{ route('home') }}"
                class="absolute bottom-6 md:bottom-8 left-6 inline-flex items-center gap-3
                  text-white text-sm md:text-base font-medium hover:text-lightGreen transition">
                <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
                Back to Home
            </a>

            <!-- Title -->
            <div class="h-full flex items-center justify-center">
                <h1 class="text-white text-3xl md:text-4xl font-semibold">
                    Tours <span class="text-lightGreen">Gallery</span>
                </h1>
            </div>

        </div>
    </section>

    <!-- ================= GALLERY CONTENT ================= -->
    <section class="max-w-7xl mx-auto px-6 py-24">

        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                Gallery
            </h2>
            <p class="text-darkGrey leading-relaxed">
                Explore a collection of photos from various tour activities<br>and experiences with Baliedu.
            </p>
        </div>

        <!-- GALLERY GRID -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($galleries as $gallery)
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $gallery->image_url) }}" loading="lazy"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="Tour Gallery">
                </div>
            @endforeach
        </div>

        <!-- ===== Pagination ===== -->
        {{ $galleries->withQueryString()->links('vendor.pagination') }}

    </section>

@endsection

@push('scripts')
@endpush
