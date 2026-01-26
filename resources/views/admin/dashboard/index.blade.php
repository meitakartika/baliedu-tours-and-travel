@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')

<section class="w-full">
    <!-- ================= DASHBOARD HEADER ================= -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <h1 class="text-2xl font-semibold text-black">
        Dashboard
    </h1>

    <!-- Filter -->
    <button
        class="flex items-center gap-4
               w-full md:w-auto
               px-5 py-4
               bg-white rounded-xl shadow-sm
               hover:shadow transition">
        
        <div class="w-10 h-10 rounded-xl bg-lightGreen flex items-center justify-center shrink-0">
            <i class="fa-solid fa-filter text-darkGreen"></i>
        </div>

        <div class="text-left flex-1">
            <p class="text-sm font-medium text-darkGrey">
                Filter Periode
            </p>
            <p class="text-xs text-mediumGrey">
                Januari 2026
            </p>
        </div>

        <i class="fa-solid fa-chevron-down text-sm text-mediumGrey"></i>
    </button>
</div>

    <!-- ================= STAT CARDS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <!-- Total Tour Packages -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm text-mediumGrey font-medium">Total Tour Packages</p>
                <div class="w-10 h-10 rounded-xl bg-lightGreen/30 flex items-center justify-center">
                    <i class="fa-solid fa-suitcase-rolling text-darkGreen text-lg"></i>
                </div>
            </div>

            <h2 class="text-3xl font-semibold mb-4">110</h2>

            <div class="flex items-center gap-2 text-sm text-darkGreen">
                <i class="fa-solid fa-arrow-trend-up"></i>
                1.5% Up from past month
            </div>
        </div>

        <!-- Total User -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm text-mediumGrey font-medium">Total User</p>
                <div class="w-10 h-10 rounded-xl bg-lightGreen/30 flex items-center justify-center">
                    <i class="fa-solid fa-user-friends text-darkGreen text-lg"></i>
                </div>
            </div>

            <h2 class="text-3xl font-semibold mb-4">405</h2>

            <div class="flex items-center gap-2 text-sm text-darkGreen">
                <i class="fa-solid fa-arrow-trend-up"></i>
                8.5% Up from past month
            </div>
        </div>

        <!-- Total Testimonials -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm text-mediumGrey font-medium">Total Testimonials</p>
                <div class="w-10 h-10 rounded-xl bg-lightGreen/30 flex items-center justify-center">
                    <i class="fa-solid fa-star text-darkGreen text-lg"></i>
                </div>
            </div>

            <h2 class="text-3xl font-semibold mb-4">223</h2>

            <div class="flex items-center gap-2 text-sm text-darkGreen">
                <i class="fa-solid fa-arrow-trend-up"></i>
                2.5% Up from past month
            </div>
        </div>

    </div>

    <!-- ================= BOOKINGS + STATUS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Total Bookings -->
        <div class="bg-white rounded-xl p-6 shadow-sm flex flex-col justify-center h-full">
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-mediumGrey font-medium">Total Bookings</p>
                <div class="w-10 h-10 rounded-xl bg-lightGreen/30 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-darkGreen text-lg"></i>
                </div>
            </div>

            <h2 class="text-3xl font-semibold mb-8">258</h2>

            <div class="flex items-center gap-2 text-sm text-darkGreen">
                <i class="fa-solid fa-arrow-trend-up"></i>
                1.5% Up from past month
            </div>
        </div>

        <!-- Status Booking -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm">
            <h3 class="text-center text-sm font-medium text-mediumGrey mb-7">
                Status Bookings in This Month
            </h3>

            <div class="flex justify-center gap-8 lg:gap-16">

                <!-- Pending -->
                <div class="text-center">
                    <div class="relative w-14 h-14 md:w-20 md:h-20 mb-5">
                        <div class="absolute inset-0 rounded-full ring-8 ring-red"></div>
                        <div class="absolute inset-1 rounded-full ring-8 ring-red"></div>
                        <div class="absolute inset-2 rounded-full ring-8 ring-red"></div>

                        <span class="absolute inset-0 flex items-center justify-center font-semibold">81%</span>
                    </div>
                    <p class="text-xs md:text-sm text-darkGrey">Pending</p>
                </div>

                <!-- Confirmed -->
                <div class="text-center">
                    <div class="relative w-14 h-14 md:w-20 md:h-20 mb-5">
                        <div class="absolute inset-0 rounded-full ring-8 ring-lightGreen"></div>
                        <div class="absolute inset-1 rounded-full ring-8 ring-lightGreen"></div>
                        <div class="absolute inset-2 rounded-full ring-8 ring-lightGreen"></div>

                        <span class="absolute inset-0 flex items-center justify-center font-semibold">22%</span>
                    </div>
                    <p class="text-xs md:text-sm text-darkGrey">Confirmed</p>
                </div>

                <!-- Completed -->
                <div class="text-center">
                    <div class="relative w-14 h-14 md:w-20 md:h-20 mb-5">
                        <div class="absolute inset-0 rounded-full ring-8 ring-darkGreen"></div>
                        <div class="absolute inset-1 rounded-full ring-8 ring-darkGreen"></div>
                        <div class="absolute inset-2 rounded-full ring-8 ring-darkGreen"></div>

                        <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold">
                            62%
                        </span>
                    </div>
                    <p class="text-xs md:text-sm text-darkGrey">Completed</p>
                </div>

            </div>
        </div>

    </div>

    <!-- ================= CHART ================= -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-base font-semibold mb-6">Chart Bookings</h3>

        <div class="h-72 flex items-center justify-center text-mediumGrey text-sm">
            Line Chart Area (Chart.js / ApexCharts)
        </div>
    </div>
</section>
@endsection
