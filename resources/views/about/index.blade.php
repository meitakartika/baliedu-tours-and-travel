@extends('layout.app')

@section('title', 'About Us')

@section('content')

    <!-- ================= HERO ABOUT ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/about-hero.png" alt="About Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-white text-3xl md:text-4xl font-semibold">
            About <span class="text-lightGreen">Us</span>
        </h1>
    </section>

    <!-- ================= ABOUT CONTENT ================= -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- LEFT IMAGE -->
            <div>
                <img src="/images/about-image.png" alt="About Baliedu" class="rounded-3xl w-full object-cover">

                <!-- STATS -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mt-12 px-2 md:px-4 lg:px-8">

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">10+</h3>
                        <p class="text-sm text-darkGrey mt-1">Years <br> Experience</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">50+</h3>
                        <p class="text-sm text-darkGrey mt-1">Amazing <br> Tours</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">500+</h3>
                        <p class="text-sm text-darkGrey mt-1">Happy <br> Customer</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-darkGreen">10+</h3>
                        <p class="text-sm text-darkGrey mt-1">Professional <br> Guides</p>
                    </div>

                </div>

            </div>

            <!-- RIGHT CONTENT -->
            <div>

                <p class="text-red font-semibold tracking-widest mb-6">
                    WHO WE ARE?
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    About Baliedu
                </h2>

                <div class="space-y-4 text-darkGrey leading-relaxed">
                    <p>
                        Baliedu is a trusted local travel agency specializing in guiding
                        and serving students and travelers who wish to explore Indonesia
                        through immersive educational tourism programs.
                        We provide high-quality information and a wide range of carefully
                        curated special-interest tours, ensuring that every journey is not
                        only memorable but also truly meaningful.
                    </p>

                    <p>
                        Embracing the concept of authentic experiences, Baliedu consistently
                        prioritizes active participation from local communities while offering
                        travelers deeper and more meaningful interactions.
                        We believe that tourism should benefit all parties involved.
                        That is why responsible tourism is the core principle behind every journey we design.
                    </p>

                    <p>
                        With Baliedu, every step of your journey becomes an opportunity to
                        learn, appreciate culture, and build a closer connection with Indonesia.
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
                    OUR SERVICES
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-paleGreen mb-4">
                    Explore Our Services
                </h2>

                <p class="text-white/90 leading-relaxed">
                    Baliedu offers travel services designed to meet your travel needs
                    in a comfortable and meaningful way.
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
                        Cultural Education & Workshops
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        Authentic cultural experiences through hands-on activities
                        with local communities and experts.
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
                        Educational Partnerships & MoU
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        Facilitating collaboration and formal agreements between schools,
                        universities, and institutions across regions or countries.
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
                        Inter-School Competitions
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        Organizing inter-school friendly competitions focused on
                        cultural and skill-based themes.
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
                        Environmental Education & Action
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        Interactive programs that raise environmental awareness and
                        encourage active participation in community conservation efforts.
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
                        Opportunity to Become Volunteer
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        Volunteer experiences to support communities or groups in need
                        through hands-on activities and collaborative programs.
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
                        Cultural Collaboration
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        Connecting cultural practitioners across regions and countries,
                        enabling interaction, learning, and shared cultural experiences.
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
                    WHY CHOOSE BALIEDU?
                </p>

                <h2 class="text-4xl font-semibold text-darkGreen mb-12">
                    Our Core Values
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
                                Fun Learning Experiences
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                Activities are designed to be both fun and educational,
                                aligned with school programs.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-spa text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                Authentic Culture and Nature
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                Participants are invited to experience local cultural
                                activities firsthand while enjoying the beauty of nature.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-hands-helping text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                Empowering Local Communities
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                Every journey aims to contribute by creating sustainable
                                economic opportunities for local communities.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-user-tie text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                Professional Team
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                Every activity is supported by our expert team, offering
                                programs designed to fit each school or group.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-hand-holding-heart text-darkGrey"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-darkGrey mb-1">
                                Safety and Comfort Guaranteed
                            </h4>
                            <p class="text-darkGrey leading-relaxed">
                                Participant safety and comfort are always our top priority,
                                ensuring a pleasant experience.
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
                    OUR VISION & MISSION
                </p>

                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    Our Commitment to You
                </h2>

                <p class="text-darkGrey leading-relaxed">
                    Baliedu’s vision and mission in creating more meaningful travel experiences.
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
                        Vision
                    </h3>

                    <p class="text-darkGrey leading-relaxed">
                        To become a leading provider of educational travel that inspires
                        experiential learning and creates a positive impact on communities
                        and the environment.
                    </p>
                </div>

                <!-- MISSIONS -->
                <div class="lg:col-span-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-2 gap-6">

                    <!-- Mission 1 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">Mission 1</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-graduation-cap text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            Providing engaging educational travel experiences relevant
                            to school programs.
                        </p>
                    </div>

                    <!-- Mission 2 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">Mission 2</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-leaf text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            Offering travel experiences that combine knowledge,
                            culture, and nature conservation.
                        </p>
                    </div>

                    <!-- Mission 3 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">Mission 3</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-coins text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            Empowering local communities through sustainable
                            economic opportunities.
                        </p>
                    </div>

                    <!-- Mission 4 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">Mission 4</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-handshake text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            Building strategic partnerships with schools,
                            educational institutions, and communities.
                        </p>
                    </div>

                    <!-- Mission 5 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">Mission 5</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-users text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            Maintaining service quality through a professional
                            team and specially designed tours.
                        </p>
                    </div>

                    <!-- Mission 6 -->
                    <div
                        class="bg-white rounded-2xl pr-4 pl-8 pt-4 pb-6 border-r-2 border-b-2 border-lightGreen
                h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-darkGrey mt-2">Mission 6</h4>
                            <div class="w-8 h-8 rounded-full bg-darkGreen flex items-center justify-center">
                                <i class="fa-solid fa-shield-halved text-white text-sm"></i>
                            </div>
                        </div>
                        <p class="text-darkGrey leading-relaxed text-sm">
                            Prioritizing participant comfort and safety
                            with well-maintained security standards.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
@endpush
