@extends('layout.admin')

@section('title', 'Testimonials')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <form method="GET" action="{{ route('testimonials.admin.index') }}" class="w-full md:max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for user/package"
                    onchange="this.form.submit()"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm focus:outline-none">
            </form>

            <!-- Filters Button -->
            <div x-data="{ open: false }" class="relative">

                @php
                    $activeFilters = collect(request()->only(['rating']))
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

                    <form method="GET" action="{{ route('testimonials.admin.index') }}">

                        <!-- keep search value -->
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <label class="text-sm font-semibold">Rating</label>

                        <div class="mt-2 space-y-2">

                            @foreach ([5, 4, 3, 2, 1] as $star)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="rating[]" value="{{ $star }}"
                                        {{ in_array($star, request('rating', [])) ? 'checked' : '' }}>
                                    <span class="text-yellow-400">
                                        @for ($i = 0; $i < $star; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </span>
                                </label>
                            @endforeach

                        </div>

                        <div class="mt-4 flex gap-2">

                            <a href="{{ route('testimonials.admin.index') }}"
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
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            @php
                                $newDirection = $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('testimonials.admin.index', [
                                'sort' => 'name',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'rating' => request('rating'),
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

                            <a href="{{ route('testimonials.admin.index', [
                                'sort' => 'package',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'rating' => request('rating'),
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
                                $newDirection = $sort === 'rating' && $direction === 'asc' ? 'desc' : 'asc';
                            @endphp

                            <a href="{{ route('testimonials.admin.index', [
                                'sort' => 'rating',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'rating' => request('rating'),
                            ]) }}"
                                class="flex items-center gap-2">
                                Rating

                                @if ($sort === 'rating')
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

                            <a href="{{ route('testimonials.admin.index', [
                                'sort' => 'date',
                                'direction' => $newDirection,
                                'search' => request('search'),
                                'rating' => request('rating'),
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
                        <th class="px-6 py-4 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y border-b border-mediumGrey/20">

                    @foreach ($testimonials as $testimonial)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($testimonial->user->profile_image)
                                        <img src="{{ asset('storage/' . $testimonial->user->profile_image) }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center">
                                            <i class="fa-solid fa-circle-user text-4xl text-darkGreen"></i>
                                        </div>
                                    @endif
                                    <span class="font-semibold text-darkGrey text-sm">
                                        {{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() == 'id' ? $testimonial->package->name_id : $testimonial->package->name_en }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                <div class="text-yellow-400">
                                    @for ($i = 0; $i < $testimonial->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor

                                    @for ($i = $testimonial->rating; $i < 5; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </div>
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() === 'id' ? $testimonial->created_at->format('d/m/Y') : $testimonial->created_at->format('m/d/Y') }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('testimonials.admin.edit', $testimonial) }}"
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
            <span>Showing {{ $testimonials->firstItem() }}–{{ $testimonials->lastItem() }}
                of {{ $testimonials->total() }} entries</span>

            <!-- Pagination -->
            <div class="flex items-center gap-1">

                {{-- Previous --}}
                @if ($testimonials->onFirstPage())
                    <span
                        class="w-9 h-9 flex items-center justify-center 
                     border rounded-lg text-mediumGrey cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $testimonials->previousPageUrl() }}"
                        class="w-9 h-9 flex items-center justify-center 
                  border rounded-lg hover:bg-mediumGrey/10">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $start = max($testimonials->currentPage() - 2, 1);
                    $end = min($testimonials->currentPage() + 2, $testimonials->lastPage());
                @endphp

                @foreach ($testimonials->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $testimonials->currentPage())
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
                @if ($testimonials->hasMorePages())
                    <a href="{{ $testimonials->nextPageUrl() }}"
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
