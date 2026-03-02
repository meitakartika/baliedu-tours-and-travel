@extends('layout.admin')

@section('title', 'Contact Info')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <form method="GET" action="{{ route('contact.info.index') }}" class="w-full md:max-w-md">
                @foreach (request()->except('search', 'page') as $key => $value)
                    @if (is_array($value))
                        @foreach ($value as $item)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for contacts"
                    onchange="this.form.submit()"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm focus:outline-none">
            </form>

            <div class="flex items-center gap-3">
                <!-- Add Button -->
                <a href="{{ route('contact.info.create') }}"
                    class="flex items-center gap-2 bg-darkGreen text-white text-sm
                   px-5 py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition">
                    <i class="fa-solid fa-plus"></i>
                    Add New Contact
                </a>

                <div x-data="{ open: false }" class="relative">

                    @php
                        $activeFilters = collect(request()->only(['type']))
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
                        class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-lg p-5 z-50">

                        <form method="GET" action="{{ route('contact.info.index') }}">

                            <!-- keep search value -->
                            <input type="hidden" name="search" value="{{ request('search') }}">

                            <label class="text-sm font-semibold">Type</label>

                            <div class="mt-2 space-y-2">

                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="type[]" value="email"
                                        {{ in_array('email', request('type', [])) ? 'checked' : '' }}>
                                    Email
                                </label>

                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="type[]" value="phone"
                                        {{ in_array('phone', request('type', [])) ? 'checked' : '' }}>
                                    Phone
                                </label>

                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="type[]" value="address"
                                        {{ in_array('address', request('type', [])) ? 'checked' : '' }}>
                                    Address
                                </label>

                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="type[]" value="office_name"
                                        {{ in_array('office_name', request('type', [])) ? 'checked' : '' }}>
                                    Office Name
                                </label>

                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="type[]" value="map_embed"
                                        {{ in_array('map_embed', request('type', [])) ? 'checked' : '' }}>
                                    Map
                                </label>

                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="type[]" value="social_media"
                                        {{ in_array('social_media', request('type', [])) ? 'checked' : '' }}>
                                    Social Media
                                </label>

                            </div>

                            <div class="mt-4 flex gap-2">

                                <a href="{{ route('contact.info.index') }}"
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

        </div>

        <!-- TABLE -->
        <div class="bg-softGrey overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead class="bg-mediumGrey/10 text-darkGrey">
                    <tr>
                        <th class="w-64 text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'type' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('contact.info.index', [
                                'sort' => 'type',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Type

                                @if ($sort === 'type')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="w-64 text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'label' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('contact.info.index', [
                                'sort' => 'label',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Label

                                @if ($sort === 'label')
                                    <i
                                        class="fa-solid {{ $direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} text-xs"></i>
                                @else
                                    <i class="fa-solid fa-sort text-xs"></i>
                                @endif
                            </a>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'value' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('contact.info.index', [
                                'sort' => 'value',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'type' => request('type'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Value

                                @if ($sort === 'value')
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
                    @foreach ($contactInfos as $contactInfo)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $contactInfo->type }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $contactInfo->label }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                <div class="max-w-[250px] truncate">
                                    {{ app()->getLocale() === 'id' ? $contactInfo->value_id : $contactInfo->value_en }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('contact.info.edit', $contactInfo) }}"
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
            <span>Showing {{ $contactInfos->firstItem() }}–{{ $contactInfos->lastItem() }}
                of {{ $contactInfos->total() }} entries</span>

            <!-- Pagination -->
            <div class="flex items-center gap-1">

                {{-- Previous --}}
                @if ($contactInfos->onFirstPage())
                    <span
                        class="w-9 h-9 flex items-center justify-center 
                     border rounded-lg text-mediumGrey cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $contactInfos->previousPageUrl() }}"
                        class="w-9 h-9 flex items-center justify-center 
                  border rounded-lg hover:bg-mediumGrey/10">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif


                {{-- Page Numbers --}}
                @php
                    $start = max($contactInfos->currentPage() - 2, 1);
                    $end = min($contactInfos->currentPage() + 2, $contactInfos->lastPage());
                @endphp

                @foreach ($contactInfos->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $contactInfos->currentPage())
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
                @if ($contactInfos->hasMorePages())
                    <a href="{{ $contactInfos->nextPageUrl() }}"
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
