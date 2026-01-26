@extends('layout.admin')

@section('title', 'Bookings')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <div class="w-full md:max-w-md">
                <input type="text" placeholder="Search for bookings"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm
                       focus:outline-none">
            </div>

            <!-- Filters Button -->
            <a href="#"
                class="flex items-center gap-2 border border-darkGreen text-darkGreen text-sm
                   px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/10 transition">
                <i class="fa-solid fa-filter"></i>
                Filters
            </a>
        </div>

        <!-- TABLE -->
        <div class="bg-softGrey overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead class="bg-mediumGrey/10 text-darkGrey">
                    <tr>
                        <th class="text-left px-4 py-4 font-semibold text-sm whitespace-nowrap">
                            ID
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Name
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Tour Package
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Date
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Guests
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Total Price
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Status
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y border-b border-mediumGrey/20">
                    @php
                        $bookings = [
                            [
                                'id' => '1',
                                'name' => 'Esthera Jackson',
                                'img' => 'https://i.pravatar.cc/100?img=1',
                                'tour' => 'Fireflies Tour',
                                'date' => '12/12/2025',
                                'guests' => '2',
                                'total' => 'Rp 1.000.000',
                                'status' => 'Pending',
                            ],
                        ];
                    @endphp

                    @foreach ($bookings as $booking)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-4 py-4 text-darkGrey text-sm">
                                {{ $booking['id'] }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $booking['img'] }}" class="w-10 h-10 rounded-full object-cover"
                                        alt="{{ $booking['name'] }}">
                                    <span class="font-semibold text-darkGrey text-sm">
                                        {{ $booking['name'] }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $booking['tour'] }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $booking['date'] }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $booking['guests'] }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $booking['total'] }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center justify-center
               px-4 py-1 rounded-md text-xs font-medium
               {{ $booking['status'] === 'Pending'
                   ? 'bg-red/10 text-red'
                   : ($booking['status'] === 'Confirmed'
                       ? 'bg-paleGreen/20 text-darkGreen'
                       : 'bg-darkGreen/10 text-darkGreen') }}">
                                    {{ $booking['status'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('bookings.edit') }}"
                                    class="inline-flex items-center gap-2
          bg-lightGreen/50 text-darkGreen font-medium
          px-4 py-2 rounded-lg
          hover:bg-lightGreen/30 transition text-sm">
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-sm text-darkGrey mt-6">
            <span>Showing 1–1 of 1 entry</span>

            <!-- Pagination -->
            <div class="flex items-center gap-1">
                <button class="w-9 h-9 border rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <button class="w-9 h-9 bg-darkGreen text-white rounded-lg">1</button>
                <button class="w-9 h-9 border rounded-lg">2</button>
                <span class="px-2">...</span>
                <button class="w-9 h-9 border rounded-lg">9</button>
                <button class="w-9 h-9 border rounded-lg">10</button>

                <button class="w-9 h-9 border rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>
@endsection
