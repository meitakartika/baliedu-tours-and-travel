@extends('layout.admin')

@section('title', __('admin.package_itinerary'))

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <form method="GET" action="{{ route('package.itinerary.index') }}" class="w-full md:max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('admin.search_itineraries') }}"
                    onchange="this.form.submit()"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm focus:outline-none">
            </form>

            <div class="flex items-center gap-3">
                <!-- Add Button -->
                <a href="{{ route('package.itinerary.create') }}"
                    class="flex items-center gap-2 bg-darkGreen text-white text-sm
                   px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition">
                    <i class="fa-solid fa-plus"></i>
                    {{ __('admin.add_new_itinerary') }}
                </a>
            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-softGrey overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead class="bg-mediumGrey/10 text-darkGrey">
                    <tr>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('package.itinerary.index', [
                                'sort' => 'name',
                                'direction' => $newDirection,
                                'search' => request('search'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.tour_package') }}

                                @if ($sort === 'name')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'itineraries' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('package.itinerary.index', [
                                'sort' => 'itineraries',
                                'direction' => $newDirection,
                                'search' => request('search'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.itineraries_count') }}

                                @if ($sort === 'itineraries')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y border-b border-mediumGrey/20">

                    @foreach ($packages as $package)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="text-left px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() == 'id' ? $package->name_id : $package->name_en }}
                            </td>

                            <td class="text-left px-6 py-4 text-darkGrey text-sm">
                                {{ $package->itineraries_count }} Itinerary
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('package.itinerary.edit', $package->id) }}"
                                    class="inline-flex items-center gap-2
          bg-lightGreen/50 text-darkGreen font-medium
          px-4 py-2 rounded-lg
          hover:bg-lightGreen/30 transition text-sm">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    {{ __('admin.edit') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-sm text-darkGrey mt-6">
            <span>{{ __('admin.showing_entries', [
                'from' => $packages->firstItem(),
                'to' => $packages->lastItem(),
                'total' => $packages->total(),
            ]) }}</span>

            <!-- Pagination -->
            <div class="flex items-center gap-1">

                {{-- Previous --}}
                @if ($packages->onFirstPage())
                    <span
                        class="w-9 h-9 flex items-center justify-center 
                     border rounded-lg text-mediumGrey cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $packages->previousPageUrl() }}"
                        class="w-9 h-9 flex items-center justify-center 
                  border rounded-lg hover:bg-mediumGrey/10">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $start = max($packages->currentPage() - 2, 1);
                    $end = min($packages->currentPage() + 2, $packages->lastPage());
                @endphp

                @foreach ($packages->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $packages->currentPage())
                        <span
                            class="w-9 h-9 flex items-center justify-center 
                         bg-darkGreen text-white rounded-lg">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="w-9 h-9 flex items-center justify-center 
                      border rounded-lg hover:bg-mediumGrey/10">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach


                {{-- Next --}}
                @if ($packages->hasMorePages())
                    <a href="{{ $packages->nextPageUrl() }}"
                        class="w-9 h-9 flex items-center justify-center 
                  border rounded-lg hover:bg-mediumGrey/10">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <span
                        class="w-9 h-9 flex items-center justify-center 
                     border rounded-lg text-mediumGrey cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                @endif

            </div>
        </div>
    </section>
@endsection
