@extends('layout.app')

@section('title', __('about.title'))

@section('content')

    <!-- ================= HERO ABOUT ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/about-hero.png" alt="About Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-white text-3xl md:text-4xl font-semibold">
            {{ __('about.hero_title_1') }} <span class="text-lightGreen">{{ __('about.hero_title_2') }}</span>
        </h1>
    </section>

    <!-- ================= ABOUT CONTENT ================= -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- LEFT IMAGE -->
            <div>
                <img src="/images/about-image.png" alt="{{ __('about.about_baliedu') }}" class="rounded-3xl w-full object-cover">

                <!-- STATS -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mt-12 px-2 md:px-4 lg:px-8">

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">{{ __('about.stats_1') }}</h3>
                        <p class="text-sm text-darkGrey mt-1">{{ __('about.years') }} <br>{{ __('about.experience') }}</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">{{ __('about.stats_2') }}</h3>
                        <p class="text-sm text-darkGrey mt-1">{{ __('about.amazing') }} <br>{{ __('about.tours') }}</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">{{ __('about.stats_3') }}</h3>
                        <p class="text-sm text-darkGrey mt-1">{{ __('about.happy') }} <br>{{ __('about.customer') }}</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">{{ __('about.stats_1') }}</h3>
                        <p class="text-sm text-darkGrey mt-1">{{ __('about.professional') }} <br>{{ __('about.guides') }}</p>
                    </div>

                </div>

            </div>

            <!-- RIGHT CONTENT -->
            <div>

                <p class="text-red font-semibold tracking-widest mb-6">
                    {{ __('about.who_we_are') }}
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    {{ __('about.about_baliedu') }}
                </h2>

                <div class="space-y-4 text-darkGrey leading-relaxed">
                    <p>
                        {{ __('about.about_p1') }}
                    </p>

                    <p>
                        {{ __('about.about_p2') }}
                    </p>

                    <p>
                        {{ __('about.about_p3') }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= OUR SERVICES ================= -->
    <section class="py-24 bg-darkGreen">
        <div class="max-w-7xl mx-auto px-6">

            <!-- HEADING -->
            <div class="text-center max-w-2xl mx-auto mb-20">
                <p class="text-white font-semibold tracking-widest mb-6">
                    {{ __('about.our_services') }}
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-paleGreen mb-4">
                    {{ __('about.explore_services') }}
                </h2>

                <p class="text-white/90 leading-relaxed">
                    {{ __('about.services_desc') }}
                </p>
            </div>

            <!-- SERVICES GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- CARD 1 -->
                <div
                    class="group bg-white rounded-xl p-8 relative overflow-hidden
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:scale-[1.02]
           hover:shadow-2xl">

                    <img src="/images/icons/curve.svg"
                        class="absolute top-0 right-0 opacity-50
               transition-opacity duration-300
               group-hover:opacity-100
               pointer-events-none"
                        alt="">

                    <div class="flex justify-center mb-6">
                        <i
                            class="fa-solid fa-chalkboard-user text-darkGreen text-4xl
              transition-transform duration-300
              group-hover:scale-110"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('about.service_1_title') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.service_1_desc') }}
                    </p>

                    <span class="absolute inset-0 border border-lightGreen/20 rounded-2xl pointer-events-none"></span>
                </div>

                <!-- CARD 2 -->
                <div
                    class="group bg-white rounded-xl p-8 relative overflow-hidden
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:scale-[1.02]
           hover:shadow-2xl">

                    <img src="/images/icons/curve.svg"
                        class="absolute top-0 right-0 opacity-50
        transform scale-x-[-1]
               transition-opacity duration-300
               group-hover:opacity-100
               pointer-events-none"
                        alt="">

                    <div class="flex justify-center mb-6">
                        <i
                            class="fa-solid fa-file-signature text-darkGreen text-4xl
              transition-transform duration-300
              group-hover:scale-110"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('about.service_2_title') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.service_2_desc') }}
                    </p>

                    <span class="absolute inset-0 border border-lightGreen/20 rounded-2xl pointer-events-none"></span>
                </div>

                <!-- CARD 3 -->
                <div
                    class="group bg-white rounded-xl p-8 relative overflow-hidden
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:scale-[1.02]
           hover:shadow-2xl">

                    <img src="/images/icons/curve.svg"
                        class="absolute top-0 right-0 opacity-50
               transition-opacity duration-300
               group-hover:opacity-100
               pointer-events-none"
                        alt="">

                    <div class="flex justify-center mb-6">
                        <i
                            class="fa-solid fa-trophy text-darkGreen text-4xl
              transition-transform duration-300
              group-hover:scale-110"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('about.service_3_title') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.service_3_desc') }}
                    </p>

                    <span class="absolute inset-0 border border-lightGreen/20 rounded-2xl pointer-events-none"></span>
                </div>

                <!-- CARD 4 -->
                <div
                    class="group bg-white rounded-xl p-8 relative overflow-hidden
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:scale-[1.02]
           hover:shadow-2xl">

                    <img src="/images/icons/curve.svg"
                        class="absolute top-0 right-0 opacity-50
        transform scale-x-[-1]
               transition-opacity duration-300
               group-hover:opacity-100
               pointer-events-none"
                        alt="">

                    <div class="flex justify-center mb-6">
                        <i
                            class="fa-solid fa-seedling text-darkGreen text-4xl
              transition-transform duration-300
              group-hover:scale-110"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('about.service_4_title') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.service_4_desc') }}
                    </p>

                    <span class="absolute inset-0 border border-lightGreen/20 rounded-2xl pointer-events-none"></span>
                </div>

                <!-- CARD 5 -->
                <div
                    class="group bg-white rounded-xl p-8 relative overflow-hidden
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:scale-[1.02]
           hover:shadow-2xl">

                    <img src="/images/icons/curve.svg"
                        class="absolute top-0 right-0 opacity-50
               transition-opacity duration-300
               group-hover:opacity-100
               pointer-events-none"
                        alt="">

                    <div class="flex justify-center mb-6">
                        <i
                            class="fa-solid fa-heart text-darkGreen text-4xl
              transition-transform duration-300
              group-hover:scale-110"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('about.service_5_title') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.service_5_desc') }}
                    </p>

                    <span class="absolute inset-0 border border-lightGreen/20 rounded-2xl pointer-events-none"></span>
                </div>

                <!-- CARD 6 -->
                <div
                    class="group bg-white rounded-xl p-8 relative overflow-hidden
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:scale-[1.02]
           hover:shadow-2xl">

                    <img src="/images/icons/curve.svg"
                        class="absolute top-0 right-0 opacity-50
        transform scale-x-[-1]
               transition-opacity duration-300
               group-hover:opacity-100
               pointer-events-none"
                        alt="">

                    <div class="flex justify-center mb-6">
                        <i
                            class="fa-solid fa-globe-asia text-darkGreen text-4xl
              transition-transform duration-300
              group-hover:scale-110"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('about.service_6_title') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.service_6_desc') }}
                    </p>

                    <span class="absolute inset-0 border border-lightGreen/20 rounded-2xl pointer-events-none"></span>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= CORE VALUES ================= -->
    <section class="py-28 bg-white relative overflow-hidden">

        <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <!-- LEFT CONTENT -->
            <div>

                <p class="text-red font-semibold tracking-widest mb-6">
                    {{ __('about.why_choose') }}
                </p>

                <h2 class="text-4xl font-semibold text-darkGreen mb-12">
                    {{ __('about.core_values') }}
                </h2>

                <!-- VALUES LIST -->
                <div class="space-y-8">

                    <!-- Item -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-book-reader text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                {{ __('about.value_1_title') }}
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                {{ __('about.value_1_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-spa text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                {{ __('about.value_2_title') }}
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                {{ __('about.value_2_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-hands-helping text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                {{ __('about.value_3_title') }}
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                {{ __('about.value_3_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-user-tie text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                {{ __('about.value_4_title') }}
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                {{ __('about.value_4_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-hand-holding-heart text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                {{ __('about.value_5_title') }}
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                {{ __('about.value_5_desc') }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="relative">

                <!-- IMAGE WRAPPER -->
                <div class="relative w-full max-w-[460px] mx-auto lg:mx-0">

                    <!-- soft gradient background (nempel ke image) -->
                    <div
                        class="absolute
               -right-32 top-[36%] -translate-y-1/2
               w-[260px] h-[260px]
               sm:w-[360px] sm:h-[360px]
               lg:w-[500px] lg:h-[500px]
               bg-darkGreen/30 rounded-full blur-3xl">
                    </div>

                    <!-- IMAGE CARD -->
                    <div class="relative
               rounded-3xl
               bg-white p-2
               shadow-lg">
                        <img src="/images/core-values.png" alt="Baliedu Experience"
                            class="w-full aspect-square object-cover rounded-2xl">
                    </div>
                </div>

                <!-- LOGO BADGE -->
                <div
                    class="absolute bottom-6 right-4
           sm:bottom-8 sm:right-6
           lg:bottom-12 lg:right-8
           bg-white rounded-2xl
           px-4 py-3 sm:px-5 sm:py-4
           shadow-2xl">

                    <img src="/images/logo.png" alt="Baliedu" class="w-28 sm:w-36 lg:w-48 h-auto">
                </div>

            </div>
        </div>
    </section>

    <!-- ================= OUR VISION & MISSION ================= -->
    <section class="py-28 bg-lightGrey">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-3xl mx-auto mb-20">
                <p class="text-red font-semibold tracking-widest mb-6">
                    {{ __('about.vision_mission') }}
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    {{ __('about.commitment') }}
                </h2>

                <p class="text-darkGrey leading-relaxed">
                    {{ __('about.vision_mission_desc') }}
                </p>
            </div>

            <!-- CONTENT GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-8 items-start">

                <!-- VISION CARD -->
                <div
                    class="lg:col-span-2
           h-full
           bg-white rounded-3xl p-10
           border-r-4 border-b-4 border-lightGreen
           flex flex-col items-center justify-center
           text-center">

                    <div
                        class="w-14 h-14 rounded-2xl bg-darkGreen
                    flex items-center justify-center mb-6">
                        <i class="fa-solid fa-bullseye text-white text-4xl"></i>
                    </div>

                    <h3 class="text-xl font-semibold text-darkGrey mb-4">
                        {{ __('about.vision') }}
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        {{ __('about.vision_desc') }}
                    </p>
                </div>

                <!-- MISSIONS -->
                <div class="lg:col-span-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-2 gap-6">

                    <!-- Mission 1 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">{{ __('about.mission') }} 1</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-graduation-cap text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            {{ __('about.mission_1') }}
                        </p>
                    </div>

                    <!-- Mission 2 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">{{ __('about.mission') }} 2</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-leaf text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            {{ __('about.mission_2') }}
                        </p>
                    </div>

                    <!-- Mission 3 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">{{ __('about.mission') }} 3</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-coins text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            {{ __('about.mission_3') }}
                        </p>
                    </div>

                    <!-- Mission 4 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">{{ __('about.mission') }} 4</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-handshake text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            {{ __('about.mission_4') }}
                        </p>
                    </div>

                    <!-- Mission 5 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">{{ __('about.mission') }} 5</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-users text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            {{ __('about.mission_5') }}
                        </p>
                    </div>

                    <!-- Mission 6 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">{{ __('about.mission') }} 6</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-shield-halved text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            {{ __('about.mission_6') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
