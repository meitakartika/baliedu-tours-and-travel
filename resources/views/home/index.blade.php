@extends('layout.app')

@section('title', 'Home')

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
</style>

@section('content')
    <!-- ================= HERO HOME ================= -->
    <section class="relative min-h-screen flex items-center">

        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="/images/hero-bg.png" alt="Hero Background" class="w-full h-full object-cover">
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6">

            <!-- Text -->
            <div class="max-w-4xl mx-auto text-white">
                <div class="max-w-2xl text-left">
                    <span class="inline-block mb-6">
                        <img src="/images/icons/ornament-line.svg" alt="" class="h-4 md:h-5 lg:h-6">
                    </span>

                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold
                   leading-relaxed md:leading-snug lg:leading-normal">
                        No matter where you’re<br>
                        going to, we’ll take you<br>
                        there
                    </h1>
                </div>
            </div>

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

    <!-- ================= CATEGORY ================= -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-red font-semibold tracking-widest mb-6">
                    CATEGORY
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    We Offer Best Services
                </h2>

                <p class="text-darkGrey leading-relaxed">
                    Enjoy a wide selection of our best tours for a more comfortable
                    and memorable Bali travel experience.
                </p>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Card 1 -->
                <div class="relative h-[380px] rounded-2xl overflow-hidden group">
                    <img src="/images/category-1.png" alt="Special Package"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <div class="relative z-10 p-6 pb-8 h-full flex flex-col justify-end text-white">
                        <h3 class="text-xl font-semibold mb-2">
                            Special Package
                        </h3>
                        <p class="text-sm text-white/90 mb-4">
                            Tour packages with more exclusive activities.
                        </p>

                        <a href="#"
                            class="flex items-center gap-2 text-lightGreen font-medium hover:text-lightGreen/80 transition">
                            See Activities
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="relative h-[380px] rounded-2xl overflow-hidden group">
                    <img src="/images/category-2.png" alt="Bali Trips"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <div class="relative z-10 p-6 pb-8 h-full flex flex-col justify-end text-white">
                        <h3 class="text-xl font-semibold mb-2">
                            Bali Trips
                        </h3>
                        <p class="text-sm text-white/90 mb-4">
                            Showcasing the beauty, culture, and unique activities of Bali.
                        </p>

                        <a href="#"
                            class="flex items-center gap-2 text-lightGreen font-medium hover:text-lightGreen/80 transition">
                            See Activities
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="relative h-[380px] rounded-2xl overflow-hidden group">
                    <img src="/images/category-3.png" alt="Homestay"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <div class="relative z-10 p-6 pb-8 h-full flex flex-col justify-end text-white">
                        <h3 class="text-xl font-semibold mb-2">
                            Homestay
                        </h3>
                        <p class="text-sm text-white/90 mb-4">
                            A comfortable and homey stay experience.
                        </p>

                        <a href="#"
                            class="flex items-center gap-2 text-lightGreen font-medium hover:text-lightGreen/80 transition">
                            See Activities
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="relative h-[380px] rounded-2xl overflow-hidden group">
                    <img src="/images/category-4.png" alt="Volunteer"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <div class="relative z-10 p-6 pb-8 h-full flex flex-col justify-end text-white">
                        <h3 class="text-xl font-semibold mb-2">
                            Volunteer
                        </h3>
                        <p class="text-sm text-white/90 mb-4">
                            Support local communities and create meaningful experiences.
                        </p>

                        <a href="#"
                            class="flex items-center gap-2 text-lightGreen font-medium hover:text-lightGreen/80 transition">
                            See Activities
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

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
                        STATISTICS
                    </p>

                    <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                        What We’ve Achieved
                    </h2>

                    <p class="text-darkGrey leading-relaxed max-w-lg">
                        Each number tells a story of journeys and the trust of travelers
                        who choose Baliedu as their partner in exploring Bali.
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
                            <h3 class="text-3xl font-bold text-darkGreen">10+</h3>
                            <p class="text-sm text-darkGrey mt-2">Years Experience</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg p-6 text-center sm:translate-y-16">
                            <i class="fa-solid fa-map text-darkGreen text-3xl mb-4"></i>
                            <h3 class="text-3xl font-bold text-darkGreen">50+</h3>
                            <p class="text-sm text-darkGrey mt-2">Amazing Tours</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <i class="fa-solid fa-star text-darkGreen text-3xl mb-4"></i>
                            <h3 class="text-3xl font-bold text-darkGreen">500+</h3>
                            <p class="text-sm text-darkGrey mt-2">Happy Customer</p>
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
                        <img src="/images/discover-main.png" alt="Bali Temple" class="w-full h-full object-cover">
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
                        <img src="/images/discover-small.png" alt="Bali Nature" class="w-full h-full object-cover">
                    </div>

                    <!-- 3D ILLUSTRATION -->
                    <img src="/images/illustration-travel.png" alt="Travel Illustration"
                        class="absolute top-32 right-1/2 translate-x-24
         md:translate-x-40
          lg:translate-x-72
            w-36 md:w-44 
            -translate-y-1/2">
                </div>

                <!-- RIGHT CONTENT -->
                <div class="max-w-xl">

                    <p class="text-red font-semibold tracking-widest mb-6">
                        GET TO KNOW US
                    </p>

                    <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                        Discover Baliedu
                    </h2>

                    <p class="text-darkGrey leading-relaxed mb-10">
                        Baliedu Tours and Travel is a local travel agency in Bali offering
                        educational, authentic, and meaningful tours. We provide experiences
                        that bring travelers closer to Bali’s culture, nature, and local life,
                        delivered through comfortable, friendly, and reliable tour services.
                        Each journey is carefully crafted to create meaningful experiences
                        and unforgettable memories.
                    </p>

                    <a href="#"
                        class="inline-flex items-center gap-3 bg-darkGreen
                          text-white px-8 py-4 rounded-lg font-medium
                          hover:bg-darkGreen/90 transition">
                        Learn More About Us
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
                    TESTIMONIALS
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold leading-tight mb-12">
                    <span class="block">What Our Travelers</span>
                    <span class="block mt-3 md:mt-4">are Saying</span>
                </h2>

                <div class="flex gap-16">
                    <div>
                        <p class="text-3xl font-semibold flex items-center gap-2">
                            4.9
                            <span>★</span>
                        </p>
                        <p class="text-sm opacity-90 mt-2">
                            100+ reviews on website
                        </p>
                    </div>

                    <div>
                        <p class="text-3xl font-semibold">
                            500+
                        </p>
                        <p class="text-sm opacity-90 mt-2">
                            Happy travelers
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
<div class="relative w-full max-w-xl h-[360px]" id="testimonial-stack">

    <!-- CARD 3 (BELAKANG) -->
    <div class="testimonial-card absolute inset-0 bg-white rounded-[40px]
        shadow-sm translate-x-8 translate-y-8 scale-95 opacity-60 z-0"
        data-index="2">
    </div>

    <!-- CARD 2 (TENGAH) -->
    <div class="testimonial-card absolute inset-0 bg-white rounded-[40px]
        shadow-md translate-x-4 translate-y-4 scale-[0.97] opacity-80 z-10"
        data-index="1">
    </div>

    <!-- CARD 1 (DEPAN / AKTIF) -->
    <div class="testimonial-card relative bg-white rounded-[40px] shadow-2xl
        p-10 z-20 h-full flex flex-col justify-between cursor-pointer"
        data-index="0">

        <!-- Quote Icon -->
        <span
            class="absolute top-10 right-12 text-[80px] font-serif font-bold
            text-lightGrey leading-none select-none pointer-events-none">
            “
        </span>

        <!-- Content -->
        <div>
            <p class="text-darkGreen text-xl font-medium mb-6 opacity-80">
                Cultural Education Tours
            </p>

            <p class="text-darkGrey font-medium leading-relaxed max-w-[90%]">
                “Cultural education activities with the local community
                made me feel truly connected to Bali. Learning directly
                from local artists and residents gave me an experience
                I couldn’t find on ordinary tours.”
            </p>
        </div>

        <!-- Author -->
        <div class="flex items-center gap-4 pt-8 border-t border-gray-100">
            <img src="/images/avatar.png"
                class="w-14 h-14 rounded-full object-cover" />

            <div>
                <p class="font-medium text-lg text-darkGrey mb-1">
                    Courtney Henry
                </p>
                <p class="text-sm text-darkGrey">
                    Jakarta, Indonesia
                </p>
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
                        GALLERY
                    </p>

                    <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                        Our Tour Gallery
                    </h2>

                    <p class="text-darkGrey leading-relaxed">
                        Authentic photos from Baliedu Tours and Travel experiences.
                    </p>
                </div>

                <div class="flex lg:items-end">
                    <a href="{{ route('gallery') }}" type="button"
                        class="inline-flex items-center justify-center
                   bg-darkGreen text-white
                   px-8 py-4 rounded-lg font-medium
                   hover:bg-darkGreen/90 transition">
                        View All Image
                    </a>
                </div>
            </div>

            <!-- GALLERY GRID -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Image 1 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 2 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 3 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 4 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 5 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 6 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 7 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

                <!-- Image 8 -->
                <div class="rounded-lg overflow-hidden">
                    <img src="/images/bali1.png"
                        class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="">
                </div>

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
                <p class="text-red font-semibold tracking-widest mb-6">FAQ</p>
                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen">
                    Frequently Asked Questions
                </h2>
            </div>

            <!-- FAQ LIST -->
            <div class="space-y-4">

                <!-- ITEM 1 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            What tour packages does Baliedu offer?
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        We offer a wide range of programs, including cultural workshops,
                        educational visits, school collaborations, environmental programs,
                        educational tours, and other experience-based activities.
                    </p>
                </div>

                <!-- ITEM 2 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            How can I book a tour package?
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        You can book directly through our website or contact our team.
                    </p>
                </div>

                <!-- ITEM 3 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            Can the program be customized to suit group needs?
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        Yes. Programs can be customized based on your group’s needs. Please contact us for further details.
                    </p>
                </div>

                <!-- ITEM 4 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            What payment options are provided?
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        We accept payments via bank transfer. Further details will be provided in the tour details.
                    </p>
                </div>

                <!-- ITEM 5 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            Is there a cancellation and refund policy?
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        Yes, we have a cancellation and refund policy.
                    </p>
                </div>

                <!-- ITEM 6 -->
                <div class="faq-item border-b border-mediumGrey/20 px-6">
                    <button class="faq-btn w-full py-5 flex items-center justify-between">
                        <span class="faq-title flex-1 text-left font-medium text-darkGrey">
                            How can I ask for more information?
                        </span>
                        <span class="text-xl text-mediumGrey">+</span>
                    </button>

                    <p class="faq-content hidden px-0 pb-4 text-mediumGrey text-sm leading-relaxed">
                        You can contact our team through the contact page or reach out to us directly for more information.
                    </p>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        //TESTIMONI
        document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.testimonial-card');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            rotateCards();
        });
    });

    function rotateCards() {
        const order = [
            {
                classes: [
                    'relative','z-20','opacity-100',
                    'translate-x-0','translate-y-0','scale-100'
                ]
            },
            {
                classes: [
                    'absolute','z-10','opacity-80',
                    'translate-x-4','translate-y-4','scale-[0.97]'
                ]
            },
            {
                classes: [
                    'absolute','z-0','opacity-60',
                    'translate-x-8','translate-y-8','scale-95'
                ]
            }
        ];

        cards.forEach(card => {
            let index = parseInt(card.dataset.index);
            let nextIndex = (index + 1) % cards.length;
            card.dataset.index = nextIndex;

            // reset semua transform
            card.className = 'testimonial-card bg-white rounded-[40px] transition-all duration-500 ease-in-out';

            // apply posisi baru
            order[nextIndex].classes.forEach(c => card.classList.add(c));
        });
    }
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
