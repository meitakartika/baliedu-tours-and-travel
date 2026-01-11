<!-- ================= TOP BAR ================= -->
<div class="relative text-white text-sm"
    style="background-image: url('/images/topbar-bg.png'); background-size: cover; background-position: center;">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        <!-- Left -->
        <div class="flex items-center gap-3 md:gap-6 text-xs">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-phone"></i>
                <span class="hidden md:inline">+62 813 5318 7669</span>
            </span>

            <span class="flex items-center gap-2">
                <i class="fa-solid fa-envelope"></i>
                <span class="hidden md:inline">baliedutours@gmail.com</span>
            </span>
        </div>

        <!-- Right -->
        <div class="flex items-center gap-3 md:gap-4">
            <a href="#" class="hover:opacity-80"> <i class="fa-brands fa-facebook-f"></i> </a>
            <a href="#" class="hover:opacity-80"> <i class="fa-brands fa-instagram"></i> </a> 
            <a href="#" class="hover:opacity-80"> <i class="fa-brands fa-twitter"></i> </a> 
            <a href="#" class="hover:opacity-80"> <i class="fa-brands fa-youtube"></i> </a> 
            <a href="#"class="hover:opacity-80 flex items-center"> <img src="{{ asset('images/icons/tripadvisor.svg') }}"
                alt="TripAdvisor" class="w-4 h-4 object-contain"> </a>
            <a href="#" class="hover:opacity-80"> <i class="fa-brands fa-flickr"></i> </a>

            <div class="h-5 border-l border-white/50"></div>

            <!-- Language -->
            <div class="relative group">
                <button class="flex items-center gap-2 hover:opacity-80 text-xs">
                    <i class="fa-solid fa-globe"></i> EN
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>

                <div
                    class="absolute right-0 top-full pt-2 w-24 bg-white text-darkGrey rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">

                    <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-lightGrey text-sm">
                        <img src="/images/icons/en.svg" class="w-4 h-4 rounded-sm"> EN
                    </a>
                    <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-lightGrey text-sm">
                        <img src="/images/icons/id.svg" class="w-4 h-4 rounded-sm"> ID
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= NAVBAR ================= -->
<nav class="bg-white shadow-sm">
    <div class="relative max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <img src="/images/logo.png" class="h-10" alt="Baliedu">

        <!-- Desktop Menu -->
        <ul class="hidden lg:flex items-center gap-8 text-sm font-medium text-darkGreen
        absolute left-1/2 -translate-x-1/2">
            <li><a href="{{ route('home') }}" class="pb-1 transition-all
            {{ request()->routeIs('home') 
                ? 'text-darkGreen border-b-2 border-darkGreen' 
                : 'text-darkGreen hover:text-paleGreen' }}">Home</a></li>

            <li class="relative group">
                <a href="#" class="flex items-center gap-2 hover:text-darkGreen">Tour Packages
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <ul
                    class="absolute left-0 mt-3 w-48 bg-white shadow-lg rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <li><a href="#" class="block px-4 py-3 hover:bg-lightGreen/20">Special Packages</a></li>
                    <li><a href="#" class="block px-4 py-3 hover:bg-lightGreen/20">Bali Trips</a></li>
                    <li><a href="#" class="block px-4 py-3 hover:bg-lightGreen/20">Homestay</a></li>
                    <li><a href="#" class="block px-4 py-3 hover:bg-lightGreen/20">Volunteer</a></li>
                </ul>
            </li>

            <li><a href="{{ route('about') }}" class="pb-1 transition-all
            {{ request()->routeIs('about') 
                ? 'text-darkGreen border-b-2 border-darkGreen' 
                : 'text-darkGreen hover:text-paleGreen' }}">About Us</a></li>
            <li><a href="{{ route('testimonials') }}" class="pb-1 transition-all
            {{ request()->routeIs('testimonials') 
                ? 'text-darkGreen border-b-2 border-darkGreen' 
                : 'text-darkGreen hover:text-paleGreen' }}">Testimonials</a></li>
            <li><a href="{{ route('contact') }}" class="pb-1 transition-all
            {{ request()->routeIs('contact') 
                ? 'text-darkGreen border-b-2 border-darkGreen' 
                : 'text-darkGreen hover:text-paleGreen' }}">Contact</a></li>
        </ul>

        <!-- Right -->
        <div class="hidden lg:flex items-center gap-4">
            <button class="text-mediumGrey hover:text-darkGreen"><i class="fa-solid fa-search"></i></button>

            <a href="#"
                class="flex items-center gap-1 text-sm font-medium text-darkGreen px-4 py-2 hover:text-paleGreen">
                Login
            </a>

            <a href="#" class="bg-darkGreen text-white text-sm font-medium px-5 py-2 rounded-md hover:opacity-90">
                Sign Up
            </a>
        </div>

        <!-- Mobile Button -->
        <div class="flex items-center gap-6 lg:hidden">
            <!-- Search -->
            <button class="text-mediumGrey hover:text-darkGreen">
                <i class="fa-solid fa-search text-base"></i>
            </button>

            <!-- Hamburger -->
            <button id="menuBtn">
                <i class="fa-solid fa-bars text-base text-darkGreen "></i>
            </button>
        </div>
    </div>
</nav>

<!-- ================= MOBILE MENU ================= -->
<div id="mobileMenu" class="lg:hidden hidden bg-white shadow-md">
    <ul class="flex flex-col text-sm font-medium text-darkGreen divide-y">
        <li><a href="{{ route('home') }}" class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Home</a>
        </li>

        <li>
            <details>
                <summary class="px-6 py-3 flex justify-between items-center">Tour Packages
                    <i class="fa-solid fa-caret-down text-base"></i>
                </summary>
                <ul class="bg-softGrey">
                    <li><a href="#"
                            class="block px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Special
                            Packages</a></li>
                    <li><a href="#"
                            class="block px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Bali
                            Trips</a></li>
                    <li><a href="#"
                            class="block px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Homestay</a>
                    </li>
                    <li><a href="#"
                            class="block px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Volunteer</a>
                    </li>
                </ul>
            </details>
        </li>

        <li><a href="{{ route('about') }}" class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">About
                Us</a></li>
        <li><a href="{{ route('testimonials') }}"
                class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Testimonials</a>
        </li>
        <li><a href="{{ route('contact') }}"
                class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Contact</a>
        </li>

        <li class="px-6 py-6 flex flex-col gap-3">
            <a href="#"
                class="py-2 text-center hover:text-paleGreen">Login</a>
            <a href="#" class="bg-darkGreen text-white rounded-md py-2 text-center hover:opacity-90">Sign Up</a>
        </li>
    </ul>
</div>

<!-- JS -->
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
