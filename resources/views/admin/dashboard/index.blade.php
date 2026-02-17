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
            <form method="GET" class="relative" x-data="{ open: false }">

                <!-- BUTTON -->
                <button type="button" @click="open = !open"
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
                            @if ($month)
                                {{ \Carbon\Carbon::createFromDate($year, $month)->translatedFormat('F Y') }}
                            @else
                                {{ $year }}
                            @endif
                        </p>
                    </div>

                    <i class="fa-solid fa-chevron-down text-sm text-mediumGrey"></i>
                </button>


                <!-- DROPDOWN -->
                <div x-show="open" @click.outside="open=false" x-transition
                    class="absolute right-0 mt-2 bg-white rounded-xl shadow-lg p-4 w-64 z-50">

                    <!-- YEAR -->
                    <label class="text-xs text-mediumGrey">Year</label>
                    <select name="year" class="w-full border border-mediumGrey rounded-lg px-3 py-2 mt-1 mb-3">

                        @for ($y = now()->year; $y >= 2025; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>

                    <!-- MONTH -->
                    <label class="text-xs text-mediumGrey">Month</label>
                    <select name="month" class="w-full border border-mediumGrey rounded-lg px-3 py-2 mt-1 mb-4">

                        <option value="">Full Year</option>

                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex-1 text-center border border-mediumGrey text-darkGrey 
                       py-2 rounded-md text-sm hover:bg-mediumGrey/10 transition">
                            Reset
                        </a>

                        <button type="submit"
                            class="flex-1 bg-darkGreen text-white 
                       py-2 rounded-md text-sm hover:bg-darkGreen/90 transition">
                            Apply
                        </button>
                    </div>

                </div>

            </form>
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

                <h2 class="text-3xl font-semibold mb-4">{{ number_format($totalPackages) }}</h2>

                <div class="flex items-center gap-2 text-sm {{ $growthPackages >= 0 ? 'text-darkGreen' : 'text-red' }}">
                    <i class="fa-solid {{ $growthPackages >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    {{ abs(round($growthPackages, 1)) }}%
                    {{ $growthPackages >= 0 ? 'Up' : 'Down' }} from past {{ $month ? 'month' : 'year' }}
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

                <h2 class="text-3xl font-semibold mb-4">{{ number_format($totalUsers) }}</h2>

                <div class="flex items-center gap-2 text-sm {{ $growthUsers >= 0 ? 'text-darkGreen' : 'text-red' }}">
                    <i class="fa-solid {{ $growthUsers >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    {{ abs(round($growthUsers, 1)) }}%
                    {{ $growthUsers >= 0 ? 'Up' : 'Down' }} from past {{ $month ? 'month' : 'year' }}
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

                <h2 class="text-3xl font-semibold mb-4">{{ number_format($totalTestimonials) }}</h2>

                <div
                    class="flex items-center gap-2 text-sm {{ $growthTestimonials >= 0 ? 'text-darkGreen' : 'text-red' }}">
                    <i class="fa-solid {{ $growthTestimonials >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    {{ abs(round($growthTestimonials, 1)) }}%
                    {{ $growthTestimonials >= 0 ? 'Up' : 'Down' }} from past {{ $month ? 'month' : 'year' }}
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

                <h2 class="text-3xl font-semibold mb-8">{{ number_format($totalBookings) }}</h2>

                <div class="flex items-center gap-2 text-sm {{ $growthBookings >= 0 ? 'text-darkGreen' : 'text-red' }}">
                    <i class="fa-solid {{ $growthBookings >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    {{ abs(round($growthBookings, 1)) }}%
                    {{ $growthBookings >= 0 ? 'Up' : 'Down' }} from past {{ $month ? 'month' : 'year' }}
                </div>
            </div>

            <!-- Status Booking -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm">
                <h3 class="text-center text-sm font-medium text-mediumGrey mb-5">
                    Status Bookings in This Month
                </h3>

                <div class="flex flex-wrap justify-center gap-8">

                    <!-- Pending -->
                    <div class="text-center">
                        <div class="relative w-28 h-28 mb-3">

                            <svg class="w-28 h-28 -rotate-90">

                                <!-- background -->
                                <circle cx="56" cy="56" r="46" stroke-width="16"
                                    class="stroke-lightGrey fill-none" />

                                <!-- progress -->
                                <circle cx="56" cy="56" r="46" stroke-width="16" fill="none"
                                    stroke="currentColor" class="text-red" stroke-dasharray="{{ 2 * pi() * 46 }}"
                                    stroke-dashoffset="{{ 2 * pi() * 46 * (1 - $pendingPercent / 100) }}"
                                    stroke-linecap="round" />
                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-semibold">
                                {{ $pendingPercent }}%
                            </span>
                        </div>
                        <p class="text-xs md:text-sm text-darkGrey">Pending</p>
                    </div>

                    <!-- Confirmed -->
                    <div class="text-center">
                        <div class="relative w-28 h-28 mb-3">

                            <svg class="w-28 h-28 -rotate-90">

                                <!-- background -->
                                <circle cx="56" cy="56" r="46" stroke-width="16"
                                    class="stroke-lightGrey fill-none" />

                                <!-- progress -->
                                <circle cx="56" cy="56" r="46" stroke-width="16" fill="none"
                                    stroke="currentColor" class="text-paleGreen" stroke-dasharray="{{ 2 * pi() * 46 }}"
                                    stroke-dashoffset="{{ 2 * pi() * 46 * (1 - $confirmedPercent / 100) }}"
                                    stroke-linecap="round" />
                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-semibold">
                                {{ $confirmedPercent }}%
                            </span>
                        </div>
                        <p class="text-xs md:text-sm text-darkGrey">Confirmed</p>
                    </div>

                    <!-- Completed -->
                    <div class="text-center">
                        <div class="relative w-28 h-28 mb-3">

                            <svg class="w-28 h-28 -rotate-90">

                                <!-- background -->
                                <circle cx="56" cy="56" r="46" stroke-width="16"
                                    class="stroke-lightGrey fill-none" />

                                <!-- progress -->
                                <circle cx="56" cy="56" r="46" stroke-width="16" fill="none"
                                    stroke="currentColor" class="text-darkGreen" stroke-dasharray="{{ 2 * pi() * 46 }}"
                                    stroke-dashoffset="{{ 2 * pi() * 46 * (1 - $completedPercent / 100) }}"
                                    stroke-linecap="round" />
                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-semibold">
                                {{ $completedPercent }}%
                            </span>
                        </div>
                        <p class="text-xs md:text-sm text-darkGrey">Completed</p>
                    </div>

                    <!-- Cancelled -->
                    <div class="text-center">
                        <div class="relative w-28 h-28 mb-3">

                            <svg class="w-28 h-28 -rotate-90">

                                <!-- background -->
                                <circle cx="56" cy="56" r="46" stroke-width="16"
                                    class="stroke-lightGrey fill-none" />

                                <!-- progress -->
                                <circle cx="56" cy="56" r="46" stroke-width="16" fill="none"
                                    stroke="currentColor" class="text-red" stroke-dasharray="{{ 2 * pi() * 46 }}"
                                    stroke-dashoffset="{{ 2 * pi() * 46 * (1 - $cancelledPercent / 100) }}"
                                    stroke-linecap="round" />
                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-semibold">
                                {{ $cancelledPercent }}%
                            </span>
                        </div>
                        <p class="text-xs md:text-sm text-darkGrey">Cancelled</p>
                    </div>

                </div>
            </div>

        </div>

        <!-- ================= CHART ================= -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <h3 class="text-base font-semibold mb-6">Chart Bookings</h3>

            <div id="bookingChart"></div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        var options = {
            chart: {
                type: 'area',
                height: 280,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },

            series: [{
                name: 'Bookings',
                data: @json($data)
            }],

            xaxis: {
                categories: @json($labels),
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },

            yaxis: {
                labels: {
                    style: {
                        colors: '#9CA3AF'
                    }
                }
            },

            stroke: {
                curve: 'smooth',
                width: 4,
                colors: ['#3F6B45']
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.35,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                },
                colors: ['#3F6B45']
            },

            markers: {
                size: 0,
                hover: {
                    size: 7
                }
            },

            grid: {
                borderColor: '#E5E7EB'
            },

            dataLabels: {
                enabled: false
            },

            tooltip: {
                enabled: true,
                theme: 'light',
                y: {
                    formatter: function(val) {
                        return val + " bookings";
                    }
                }
            }
        };

        new ApexCharts(document.querySelector("#bookingChart"), options).render();
    </script>
@endpush
