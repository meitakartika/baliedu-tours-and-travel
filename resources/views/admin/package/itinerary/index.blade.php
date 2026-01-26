@extends('layout.admin')

@section('title', 'Package Itinerary')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <div class="w-full md:max-w-md">
                <input type="text" placeholder="Search for itineraries"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm
                       focus:outline-none">
            </div>

            <div class="flex items-center gap-3">
                <!-- Add Button -->
                <a href="{{ route('package.itinerary.create') }}"
                    class="flex items-center gap-2 bg-darkGreen text-white text-sm
                   px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition">
                    <i class="fa-solid fa-plus"></i>
                    Add New Itinerary
                </a>

                <!-- Filters Button -->
                <a href="#"
                    class="flex items-center gap-2 border border-darkGreen text-darkGreen text-sm
                   px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/10 transition">
                    <i class="fa-solid fa-filter"></i>
                    Filters
                </a>
            </div>
            
        </div>

        <!-- TABLE -->
        <div class="bg-softGrey overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead class="bg-mediumGrey/10 text-darkGrey">
                    <tr>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Tour Package
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Time
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Title
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y border-b border-mediumGrey/20">
                    @php
                        $itineraries = [
                            [
                                'tour'  => 'Fireflies Tour',
                                'time'  => '18.00',
                                'title' => 'Dinner',
                            ],
                        ];
                    @endphp

                    @foreach ($itineraries as $itinerary)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $itinerary['tour'] }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $itinerary['time'] }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $itinerary['title'] }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('package.itinerary.edit') }}"
                                    class="inline-flex items-center gap-2
          bg-lightGreen/50 text-darkGreen font-medium
          px-4 py-2 rounded-lg
          hover:bg-lightGreen/30 transition text-sm">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-sm text-darkGrey mt-6">
            <span>Showing 1-1 of 1 entry</span>

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
