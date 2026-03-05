<!-- ================= TOP BAR ================= -->
<div class="relative z-50 text-white text-sm"
    style="background-image: url('/images/topbar-bg.png'); background-size: cover; background-position: center;">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        <!-- Left -->
        <div class="flex items-center gap-3 md:gap-6 text-xs">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-phone"></i>
                <span
                    class="hidden md:inline">{{ app()->getLocale() === 'id' ? $adminPhone->value_id : $adminPhone->value_en }}</span>
            </span>

            <span class="flex items-center gap-2">
                <i class="fa-solid fa-envelope"></i>
                <span
                    class="hidden md:inline">{{ app()->getLocale() === 'id' ? $adminEmail->value_id : $adminEmail->value_en }}</span>
            </span>
        </div>

        <!-- Right -->
        <div class="flex items-center gap-3 md:gap-4">
            @foreach ($socialMedias as $sm)
                @php
                    $iconClass = '';
                    $isImage = false;

                    // Tentukan icon FontAwesome / image
                    switch (strtolower($sm->label)) {
                        case 'facebook':
                            $iconClass = 'fa-brands fa-facebook-f';
                            break;
                        case 'instagram':
                            $iconClass = 'fa-brands fa-instagram';
                            break;
                        case 'twitter':
                        case 'x':
                            $iconClass = 'fa-brands fa-twitter';
                            break;
                        case 'youtube':
                            $iconClass = 'fa-brands fa-youtube';
                            break;
                        case 'tripadvisor':
                            $isImage = true;
                            $imageSrc = asset('images/icons/tripadvisor.svg');
                            break;
                        case 'flickr':
                            $iconClass = 'fa-brands fa-flickr';
                            break;
                    }
                @endphp

                @if ($isImage)
                    <a href="{{ app()->getLocale() === 'id' ? $sm->value_id : $sm->value_en }}" target="_blank"
                        class="hover:opacity-80 flex items-center">
                        <img src="{{ $imageSrc }}" alt="{{ $sm->label }}" class="w-4 h-4 object-contain">
                    </a>
                @else
                    <a href="{{ app()->getLocale() === 'id' ? $sm->value_id : $sm->value_en }}" target="_blank"
                        class="hover:opacity-80">
                        <i class="{{ $iconClass }}"></i>
                    </a>
                @endif
            @endforeach

            <div class="h-5 border-l border-white/50"></div>

            <!-- Language -->
<div class="relative group">
    <button class="flex items-center gap-2 hover:opacity-80 text-xs">
        <i class="fa-solid fa-globe"></i>
        {{ strtoupper(app()->getLocale()) }}
        <i class="fa-solid fa-chevron-down text-xs"></i>
    </button>

    <div
        class="absolute right-0 mt-2 w-24 bg-white text-darkGrey rounded-md shadow-lg
        opacity-0 invisible group-hover:opacity-100 group-hover:visible
        transition-all duration-200">

        <a href="{{ route('language.switch', ['locale' => 'en']) }}"
           class="flex items-center gap-2 px-3 py-2 hover:bg-lightGrey text-sm">
            <img src="/images/icons/en.svg" class="w-4 h-4 rounded-sm">
            EN
        </a>

        <a href="{{ route('language.switch', ['locale' => 'id']) }}"
           class="flex items-center gap-2 px-3 py-2 hover:bg-lightGrey text-sm">
            <img src="/images/icons/id.svg" class="w-4 h-4 rounded-sm">
            ID
        </a>
    </div>
</div>
        </div>
    </div>
</div>

<!-- ================= NAVBAR ================= -->
<nav class="relative z-40 bg-white shadow-sm" x-data="{ open: false }">
    <div class="relative max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <img src="/images/logo.png" class="h-10" alt="Baliedu">

        <!-- Desktop Menu -->
        <ul
            class="hidden lg:flex items-center gap-8 text-sm font-medium text-darkGreen
        absolute left-1/2 -translate-x-1/2">
            <li>
                <a href="{{ route('home') }}"
                    class="pb-1 transition-all
       {{ request()->is('/') || request()->routeIs('home')
           ? 'text-darkGreen border-b-2 border-darkGreen'
           : 'text-darkGreen hover:text-paleGreen' }}">
                    {{ __('layout.home') }}
                </a>
            </li>

            @php
                $isTourActive = request()->routeIs('tours.*');
            @endphp

            <li class="relative group">
                <a href="#"
                    class="flex items-center gap-2 py-2 pb-1 transition-all
       {{ $isTourActive ? 'text-darkGreen border-b-2 border-darkGreen' : 'hover:text-darkGreen' }}">
                    {{ __('layout.tour_packages') }}
                    <i class="fa-solid fa-caret-down"></i>
                </a>

                <ul
                    class="absolute left-0 top-full w-48 bg-white shadow-lg rounded-lg
    opacity-0 invisible group-hover:opacity-100 group-hover:visible
    transition-all duration-200 z-40">

                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('tours.category', $category->id) }}"
                                class="block px-4 py-3 hover:bg-lightGreen/20">
                                {{ app()->getLocale() === 'id' ? $category->name_id : $category->name_en }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </li>

            <li><a href="{{ route('about') }}"
                    class="pb-1 transition-all
            {{ request()->routeIs('about')
                ? 'text-darkGreen border-b-2 border-darkGreen'
                : 'text-darkGreen hover:text-paleGreen' }}">{{ __('layout.about_us') }}</a></li>
            <li><a href="{{ route('testimonials') }}"
                    class="pb-1 transition-all
            {{ request()->routeIs('testimonials')
                ? 'text-darkGreen border-b-2 border-darkGreen'
                : 'text-darkGreen hover:text-paleGreen' }}">{{ __('layout.testimonials') }}</a>
            </li>
            <li><a href="{{ route('contact') }}"
                    class="pb-1 transition-all
            {{ request()->routeIs('contact')
                ? 'text-darkGreen border-b-2 border-darkGreen'
                : 'text-darkGreen hover:text-paleGreen' }}">{{ __('layout.contact') }}</a>
            </li>
        </ul>

        <!-- Right -->
        <div class="hidden lg:flex items-center gap-4">

            <!-- SEARCH ICON -->
            <button @click="open = true" class="text-mediumGrey hover:text-darkGreen">
                <i class="fa-solid fa-search"></i>
            </button>

            @guest
                <a href="{{ route('login') }}"
                    class="flex items-center gap-1 text-sm font-medium text-darkGreen px-4 py-2 hover:text-paleGreen">
                    {{ __('layout.login') }}
                </a>

                <a href="{{ route('register') }}"
                    class="bg-darkGreen text-white text-sm font-medium px-5 py-2 rounded-md hover:opacity-90">
                    {{ __('layout.sign_up') }}
                </a>
            @endguest

            @auth
                <div class="relative group">
                    <button class="flex items-center gap-3 px-3 py-2 hover:opacity-90">
                        {{-- Icon profile --}}
                        @if (Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                class="w-6 h-6 rounded-full object-cover">
                        @else
                            <i class="fa-solid fa-circle-user text-2xl text-darkGreen"></i>
                        @endif
                        <i class="fa-solid fa-caret-down text-base text-darkGreen"></i>
                    </button>

                    <ul
                        class="absolute right-0 top-full mt-2 w-48 bg-white text-sm font-medium text-darkGreen rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <li>
                            @php
                                $pendingCount = \App\Models\Booking::where('user_id', auth()->id())
                                    ->where('status', 'completed')
                                    ->whereDoesntHave('review')
                                    ->count();
                            @endphp
                            <a href="{{ route('account') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-lightGreen/20">{{ __('layout.account') }}
                                @if ($pendingCount > 0)
                                    <span
                                        class="inline-flex items-center justify-center
                         w-5 h-5 text-xs bg-red text-white rounded-full">
                                        {{ $pendingCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <hr class="border-t border-lightGrey">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-lightGreen/20">
                                    <i class="fa-solid fa-sign-out-alt fa-flip-horizontal mr-2"></i>{{ __('layout.logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

        </div>

        <!-- Mobile Button -->
        <div class="flex items-center gap-6 lg:hidden">
            <!-- Search -->
            <button @click="open = true" class="text-mediumGrey hover:text-darkGreen">
                <i class="fa-solid fa-search text-base"></i>
            </button>

            <!-- Hamburger -->
            <button id="menuBtn">
                <i class="fa-solid fa-bars text-base text-darkGreen "></i>
            </button>
        </div>
    </div>
    <!-- OVERLAY -->
    <div x-show="open" x-cloak x-transition.opacity @keydown.escape.window="open = false" @click.self="open = false"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 flex items-start justify-center pt-40">

        <!-- SEARCH BOX -->
        <div x-transition class="bg-white rounded-2xl shadow-xl pt-10 pb-4 px-6 w-full max-w-xl relative">

            <!-- CLOSE BUTTON -->
            <button @click="open = false" class="absolute top-4 right-4 text-mediumGrey hover:text-darkGreen">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- FORM -->
            <form action="{{ route('search') }}" method="GET" class="flex items-center gap-4">

                <input type="text" name="location" placeholder="{{ __('layout.search_placeholder') }}"
                    class="flex-1 border rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-darkGreen"
                    autofocus>

                <button type="submit"
                    class="bg-darkGreen text-white text-sm px-5 py-2 rounded-lg hover:bg-darkGreen/90 transition">
                    {{ __('layout.search_button') }}
                </button>

            </form>

        </div>
    </div>
</nav>

<!-- ================= MOBILE MENU ================= -->
<div id="mobileMenu" class="lg:hidden hidden bg-white shadow-md">
    <ul class="flex flex-col text-sm font-medium text-darkGreen divide-y">
        <li><a href="{{ route('home') }}"
                class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">{{ __('layout.home') }}</a>
        </li>

        <li>
            <details>
                <summary class="px-6 py-3 flex justify-between items-center cursor-pointer">
                    {{ __('layout.tour_packages') }}
                    <i class="fa-solid fa-caret-down text-base"></i>
                </summary>

                <ul class="bg-softGrey">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('tours.category', $category->id) }}"
                                class="block px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">
                                {{ app()->getLocale() === 'id' ? $category->name_id : $category->name_en }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </details>
        </li>

        <li><a href="{{ route('about') }}"
                class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">{{ __('layout.about_us') }}</a></li>
        <li><a href="{{ route('testimonials') }}"
                class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">{{ __('layout.testimonials') }}</a>
        </li>
        <li><a href="{{ route('contact') }}"
                class="block px-6 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">{{ __('layout.contact') }}</a>
        </li>

        <li>
            @auth
                <details>
                    <summary class="px-6 py-3 flex justify-between items-center w-full gap-3 hover:opacity-90">
                        <div class="w-6 h-6 rounded-full bg-darkGreen flex items-center justify-center">
                            <i class="fa-solid fa-user text-white text-xs"></i>
                        </div>
                        <i class="fa-solid fa-caret-down text-base"></i>
                    </summary>
                    <ul class="bg-softGrey">
                        <li>
                            @php
                                $pendingCount = \App\Models\Booking::where('user_id', auth()->id())
                                    ->where('status', 'completed')
                                    ->whereDoesntHave('review')
                                    ->count();
                            @endphp
                            <a href="{{ route('account') }}"
                                class="flex items-center gap-3 px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">Account
                                @if ($pendingCount > 0)
                                    <span
                                        class="inline-flex items-center justify-center
                         w-5 h-5 text-xs bg-red text-white rounded-full">
                                        {{ $pendingCount }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block px-8 py-3 transition hover:bg-lightGreen/20 hover:text-darkGreen">
                                    <i class="fa-solid fa-sign-out-alt fa-flip-horizontal mr-2"></i>{{ __('layout.logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </details>
            @endauth
        </li>
        <li class="px-6 py-6 flex flex-col gap-3">

            @guest
                <a href="{{ route('login') }}" class="py-2 text-center hover:text-paleGreen">{{ __('layout.login') }}</a>
                <a href="{{ route('register') }}"
                    class="bg-darkGreen text-white rounded-md py-2 text-center hover:opacity-90">{{ __('layout.sign_up') }}</a>
            @endguest
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
