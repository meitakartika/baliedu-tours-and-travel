@extends('layout.admin')

@section('title', __('admin.title'))

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <form method="GET" action="{{ route('package.tour.index') }}" class="w-full md:max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('admin.search_placeholder') }}"
                    onchange="this.form.submit()"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm focus:outline-none">
            </form>

            <div class="flex items-center gap-3">
                <!-- Add Button -->
                <a href="{{ route('package.tour.create') }}"
                    class="flex items-center gap-2 bg-darkGreen text-white text-sm
                   px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition">
                    <i class="fa-solid fa-plus"></i>
                    {{ __('admin.add_package') }}
                </a>

                <!-- Filters Button -->
                <div x-data="{ open: false }" class="relative">

                    @php
                        $activeFilters = collect(request()->only(['category', 'type']))
                            ->flatten()
                            ->filter()
                            ->count();
                    @endphp

                    <!-- BUTTON -->
                    <button @click="open = !open"
                        class="relative flex items-center gap-2 border border-darkGreen text-darkGreen text-sm
           px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/10 transition">

                        <i class="fa-solid fa-filter"></i>
                        {{ __('admin.filter') }}

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

                        <form method="GET" action="{{ route('package.tour.index') }}">

                            <!-- keep search value -->
                            <input type="hidden" name="search" value="{{ request('search') }}">

                            <label class="text-sm font-semibold">{{ __('admin.category') }}</label>

                            <div class="mt-2 space-y-2">

                                @foreach ($categories as $category)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>
                                        {{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}
                                    </label>
                                @endforeach

                            </div>

                            <label class="text-sm font-semibold mt-4 block">{{ __('admin.type') }}</label>

                            <div class="mt-2 space-y-2">

                                @foreach ($types as $type)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" name="type[]" value="{{ $type->id }}"
                                            {{ in_array($type->id, request('type', [])) ? 'checked' : '' }}>
                                        {{ app()->getLocale() == 'id' ? $type->name_id : $type->name_en }}
                                    </label>
                                @endforeach

                            </div>

                            <div class="mt-4 flex gap-2">

                                <a href="{{ route('package.tour.index') }}"
                                    class="flex-1 text-center border border-mediumGrey text-darkGrey 
               py-2 rounded-md text-sm hover:bg-mediumGrey/10 transition">
                                    {{ __('admin.reset') }}
                                </a>

                                <button type="submit"
                                    class="flex-1 bg-darkGreen text-white 
               py-2 rounded-md text-sm hover:bg-darkGreen/90 transition">
                                    {{ __('admin.apply') }}
                                </button>

                            </div>

                        </form>
                    </div>

                </div>
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

                            <a href="{{ route('package.tour.index', [
                                'sort' => 'name',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'category' => request('category'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.name') }}

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
                                $newDirection = $sort === 'category' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('package.tour.index', [
                                'sort' => 'category',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'category' => request('category'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.category') }}

                                @if ($sort === 'category')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'type' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('package.tour.index', [
                                'sort' => 'type',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'category' => request('category'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.type') }}

                                @if ($sort === 'type')
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

                            <a href="{{ route('package.tour.index', [
                                'sort' => 'price',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'category' => request('category'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.price') }}

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
                                $newDirection = $sort === 'duration' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('package.tour.index', [
                                'sort' => 'duration',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'category' => request('category'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.duration') }}

                                @if ($sort === 'duration')
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

                            <a href="{{ route('package.tour.index', [
                                'sort' => 'guests',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'category' => request('category'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                {{ __('admin.guests') }}

                                @if ($sort === 'guests')
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
                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() == 'id' ? $package->name_id : $package->name_en }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() == 'id' ? $package->category->name_id : $package->category->name_en }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() == 'id' ? $package->type->name_id : $package->type->name_en }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $package->duration }} {{ __('admin.day') }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $package->guest_min }} - {{ $package->guest_max }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('package.tour.edit', $package) }}"
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
