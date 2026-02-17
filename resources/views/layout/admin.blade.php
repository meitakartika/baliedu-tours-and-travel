<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        darkGreen: '#2D7737',
                        lightGreen: '#D0E497',
                        paleGreen: '#C7DA7C',
                        red: '#E21B2C',
                        darkGrey: '#3A3A3A',
                        mediumGrey: '#828282',
                        lightGrey: '#F2F2F2',
                        softGrey: '#FAFAFA',
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- ApexChart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="font-poppins">

    <div class="flex min-h-screen w-full">

        <!-- ================= SIDEBAR ================= -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50
           w-72 bg-white
           transform -translate-x-full
           transition-transform duration-300
           md:relative md:translate-x-0">

            <div>
                <!-- Logo -->
                <div class="px-6 py-10 flex items-center justify-center">
                    <img src="/images/logo.png" class="h-12" alt="">
                </div>

                <!-- Menu -->
                <nav class="px-6">
                    <div class="space-y-2">
                        <!-- Active -->
                        <div class="relative">
                            <span
                                class="absolute -left-6 top-0 h-full w-2 rounded-r-full
        {{ request()->routeIs('admin.dashboard') ? 'bg-darkGreen' : 'bg-transparent' }}">
                            </span>

                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-4 px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.dashboard') ? 'bg-darkGreen text-white' : 'text-darkGrey hover:text-paleGreen' }}">
                                <i class="fa-solid fa-home"></i>
                                Dashboard
                            </a>
                        </div>

                        <div class="relative">
                            <span
                                class="absolute -left-6 top-0 h-full w-2 rounded-r-full
        {{ request()->routeIs('customers.*') ? 'bg-darkGreen' : 'bg-transparent' }}">
                            </span>

                            <a href="{{ route('customers.index') }}"
                                class="flex items-center gap-4 px-4 py-3 rounded-lg
       {{ request()->routeIs('customers.*') ? 'bg-darkGreen text-white' : 'text-darkGrey hover:text-paleGreen' }}">
                                <i class="fa-solid fa-user-friends"></i>
                                Customers
                            </a>
                        </div>

                        <!-- Dropdown -->
                        @php
                            $packageActive = request()->routeIs('package.*');
                        @endphp

                        <div class="relative group">

                            <!-- ACTIVE INDICATOR -->
                            <span
                                class="absolute -left-6 top-0 h-full w-2 rounded-r-full
        {{ $packageActive ? 'bg-darkGreen' : 'bg-transparent' }}">
                            </span>

                            <!-- MAIN BUTTON -->
                            <div
                                class="flex items-center justify-between w-full
               px-4 py-3 rounded-lg cursor-pointer
               {{ $packageActive ? 'bg-darkGreen text-white' : 'text-darkGrey hover:text-paleGreen' }}">
                                <span class="flex items-center gap-4">
                                    <i class="fa-solid fa-suitcase-rolling"></i>
                                    Tour Package
                                </span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>

                            <!-- SUB MENU -->
                            <div
                                class="ml-8 mt-2 space-y-1 {{ $packageActive ? 'block' : 'hidden' }} group-hover:block">

                                <!-- Category -->
                                <a href="{{ route('package.category.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('package.category.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    Category
                                </a>

                                <!-- Type -->
                                <a href="{{ route('package.type.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('package.type.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    Type
                                </a>

                                <!-- Package -->
                                <a href="{{ route('package.tour.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('package.tour.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    Package Tour
                                </a>

                                <!-- Itinerary -->
                                <a href="{{ route('package.itinerary.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('package.itinerary.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    Itinerary
                                </a>

                                <!-- List -->
                                <a href="{{ route('package.list.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('package.list.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    List
                                </a>

                            </div>
                        </div>

                        <div class="relative">
                            <span
                                class="absolute -left-6 top-0 h-full w-2 rounded-r-full
        {{ request()->routeIs('bookings.*') ? 'bg-darkGreen' : 'bg-transparent' }}">
                            </span>

                            <a href="{{ route('bookings.index') }}"
                                class="flex items-center gap-4 px-4 py-3 rounded-lg
       {{ request()->routeIs('bookings.*') ? 'bg-darkGreen text-white' : 'text-darkGrey hover:text-paleGreen' }}">
                                <i class="fa-solid fa-calendar"></i>
                                Bookings
                            </a>
                        </div>

                        <div class="relative">
                            <span
                                class="absolute -left-6 top-0 h-full w-2 rounded-r-full
        {{ request()->routeIs('admin.testimonials.*') ? 'bg-darkGreen' : 'bg-transparent' }}">
                            </span>

                            <a href="{{ route('testimonials.admin.index') }}"
                                class="flex items-center gap-4 px-4 py-3 rounded-lg
       {{ request()->routeIs('admin.testimonials.*') ? 'bg-darkGreen text-white' : 'text-darkGrey hover:text-paleGreen' }}">
                                <i class="fa-solid fa-user-friends"></i>
                                Testimonials
                            </a>
                        </div>

                        @php
                            $contactActive = request()->routeIs('contact.*');
                        @endphp

                        <div class="relative group">

                            <!-- ACTIVE INDICATOR -->
                            <span
                                class="absolute -left-6 top-0 h-full w-2 rounded-r-full
        {{ $contactActive ? 'bg-darkGreen' : 'bg-transparent' }}">
                            </span>

                            <!-- MAIN BUTTON -->
                            <div
                                class="flex items-center justify-between w-full
               px-4 py-3 rounded-lg cursor-pointer
               {{ $contactActive ? 'bg-darkGreen text-white' : 'text-darkGrey hover:text-paleGreen' }}">
                                <span class="flex items-center gap-4">
                                    <i class="fa-solid fa-address-book"></i>
                                    Contact
                                </span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>

                            <!-- SUB MENU -->
                            <div
                                class="
            ml-8 mt-2 space-y-1
            {{ $contactActive ? 'block' : 'hidden' }}
            group-hover:block
        ">

                                <!-- Contact Info -->
                                <a href="{{ route('contact.info.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('contact.info.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    Contact Info
                                </a>

                                <!-- Contact Message -->
                                <a href="{{ route('contact.messages.index') }}"
                                    class="block px-4 py-2 rounded-md text-sm
           {{ request()->routeIs('contact.messages.*')
               ? 'text-darkGreen font-semibold'
               : 'text-mediumGrey hover:text-darkGreen' }}">
                                    Contact Message
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="-mx-6 my-5 border-t border-lightGrey"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-4 px-4 py-3 rounded-lg
          text-darkGrey hover:text-red">
                            <i class="fa-solid fa-right-from-bracket"></i>Logout</button>
                    </form>
                </nav>

            </div>

        </aside>

        <!-- ================= MAIN ================= -->
        <div class="flex-1 flex flex-col bg-softGrey">

            <!-- ================= HEADER ================= -->
            <header
                class="bg-white w-full box-border
           px-4 sm:px-6 md:px-16 py-4
           flex flex-wrap items-center justify-start gap-x-4 gap-y-3">

                <!-- LEFT -->
                <div class="flex items-center gap-4 min-w-0">

                    <!-- Burger -->
                    <button onclick="toggleSidebar()" class="md:hidden text-darkGrey text-xl shrink-0">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <!-- Search -->
                    <div class="w-full max-w-md relative hidden sm:block">
                        <i
                            class="fa-solid fa-magnifying-glass
               absolute left-4 top-1/2 -translate-y-1/2 text-mediumGrey"></i>
                        <input type="text" placeholder="Search"
                            class="w-full pl-12 pr-4 py-2 rounded-full
                       bg-lightGrey focus:outline-none">
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4 shrink-0 ml-auto">

                    <!-- Language -->
                    <div class="relative group shrink-0">
                        <button class="flex items-center gap-2 hover:opacity-80 text-sm">
                            <i class="fa-solid fa-globe"></i> EN
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>

                        <div
                            class="absolute right-0 top-full pt-2 w-24
                       bg-white text-darkGrey rounded-md shadow-lg
                       opacity-0 invisible
                       group-hover:opacity-100 group-hover:visible
                       transition-all duration-200">
                            <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-lightGrey text-sm">
                                <img src="/images/icons/en.svg" class="w-4 h-4 rounded-sm"> EN
                            </a>
                            <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-lightGrey text-sm">
                                <img src="/images/icons/id.svg" class="w-4 h-4 rounded-sm"> ID
                            </a>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-8 w-px bg-mediumGrey shrink-0"></div>

                    <!-- User -->
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('admin.account.index') }}" class="flex items-center gap-3">
                            @if (Auth::user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                    class="w-6 h-6 rounded-full object-cover">
                            @else
                                <i class="fa-solid fa-circle-user text-2xl text-darkGreen"></i>
                            @endif
                            <div class="text-sm hidden md:block">
                                <p class="font-semibold text-darkGrey">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</p>
                                <p class="text-xs text-darkGrey">Admin</p>
                            </div>
                        </a>
                    </div>

                </div>

            </header>

            <!-- ================= CONTENT ================= -->
            <main class="flex-1 w-full min-w-0 overflow-x-hidden
     px-4 sm:px-6 md:px-16
     py-6 md:py-10">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar')
                .classList.toggle('-translate-x-full');
        }

        function confirmDelete(formId, title = 'Delete Data?', text = 'This action cannot be undone!') {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E21B2C',
                cancelButtonColor: '#828282',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</body>

</html>
