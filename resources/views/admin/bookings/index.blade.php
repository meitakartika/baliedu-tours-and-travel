@extends('layout.admin')

@section('title', 'Bookings')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <form method="GET" action="{{ route('bookings.index') }}" class="w-full md:max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for user/package"
                    onchange="this.form.submit()"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm focus:outline-none">
            </form>

            <!-- Filters Button -->
            <div x-data="{ open: false }" class="relative">

                @php
                    $activeFilters = collect(request()->only(['status']))
                        ->flatten()
                        ->filter()
                        ->count();
                @endphp

                <!-- BUTTON -->
                <button @click="open = !open"
                    class="relative flex items-center gap-2 border border-darkGreen text-darkGreen text-sm
           px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/10 transition">

                    <i class="fa-solid fa-filter"></i>
                    Filter

                    @if ($activeFilters > 0)
                        <span
                            class="absolute -top-2 -right-2 
                     bg-darkGreen text-white text-xs 
                     w-5 h-5 flex items-center justify-center 
                     rounded-full">
                            {{ $activeFilters }}
                        </span>
                    @endif

                </button>

                <!-- PANEL -->
                <div x-show="open" @click.outside="open=false"
                    class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-lg p-5 z-50 max-h-96 overflow-y-auto">

                    <form method="GET" action="{{ route('bookings.index') }}">

                        <!-- keep search value -->
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <label class="text-sm font-semibold">Status</label>

                        <div class="mt-2 space-y-2">

                            @foreach ($status as $item)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="status[]" value="{{ $item }}"
                                        {{ in_array($item, request('status', [])) ? 'checked' : '' }}>
                                    {{ $item }}
                                </label>
                            @endforeach

                        </div>

                        <div class="mt-4 flex gap-2">

                            <a href="{{ route('bookings.index') }}"
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

                    </form>
                </div>

            </div>
        </div>

        <!-- TABLE -->
        <div class="bg-softGrey overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead class="bg-mediumGrey/10 text-darkGrey">
                    <tr>
                        <th class="text-left px-4 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'id' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'id',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                ID

                                @if ($sort === 'id')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'name',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Name

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
                                $newDirection = $sort === 'package' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'package',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Tour Package

                                @if ($sort === 'package')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'date' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'date',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Date

                                @if ($sort === 'date')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'guests' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'guests',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Guests

                                @if ($sort === 'guests')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'price' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'price',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Total Price

                                @if ($sort === 'price')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'status' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('bookings.index', [
                                'sort' => 'status',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'status' => request('status'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Status

                                @if ($sort === 'status')
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

                    @foreach ($bookings as $booking)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-4 py-4 text-darkGrey text-sm">
                                {{ $booking['id'] }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($booking->user->profile_image)
                                        <img src="{{ asset('storage/' . $booking->user->profile_image) }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center">
                                            <i class="fa-solid fa-circle-user text-4xl text-darkGreen"></i>
                                        </div>
                                    @endif
                                    <span class="font-semibold text-darkGrey text-sm">
                                        {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() == 'id' ? $booking->package->name_id : $booking->package->name_en }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() === 'id'
                                    ? \Carbon\Carbon::parse($booking->tour_date)->format('d/m/Y')
                                    : \Carbon\Carbon::parse($booking->tour_date)->format('m/d/Y') }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $booking->guest_count }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>

                            @php
                                $statusColor = match ($booking->status) {
                                    'pending' => 'bg-red/10 text-red',
                                    'confirmed' => 'bg-paleGreen/20 text-darkGreen',
                                    'completed' => 'bg-darkGreen/10 text-darkGreen',
                                    'cancelled' => 'bg-red/20 text-red',
                                };
                            @endphp

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center justify-center
               px-4 py-1 rounded-md text-xs font-medium
               {{ $statusColor }}">
                                    {{ $booking->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('bookings.edit', $booking->id) }}"
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
            <span>Showing {{ $bookings->firstItem() }}–{{ $bookings->lastItem() }}
                of {{ $bookings->total() }} entries</span>

            <!-- Pagination -->
            <div class="flex items-center gap-1">

                {{-- Previous --}}
                @if ($bookings->onFirstPage())
                    <span
                        class="w-9 h-9 flex items-center justify-center 
                     border rounded-lg text-mediumGrey cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $bookings->previousPageUrl() }}"
                        class="w-9 h-9 flex items-center justify-center 
                  border rounded-lg hover:bg-mediumGrey/10">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $start = max($bookings->currentPage() - 2, 1);
                    $end = min($bookings->currentPage() + 2, $bookings->lastPage());
                @endphp

                @foreach ($bookings->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $bookings->currentPage())
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
                @if ($bookings->hasMorePages())
                    <a href="{{ $bookings->nextPageUrl() }}"
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
