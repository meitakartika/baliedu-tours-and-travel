@extends('layout.admin')

@section('title', 'Contact Messages')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <form method="GET" action="{{ route('contact.messages.index') }}" class="w-full md:max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for users/date/email"
                    onchange="this.form.submit()"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm focus:outline-none">
            </form>

            <div x-data="{ open: false }" class="relative">

                @php
                    $activeFilters = collect(request()->only(['type']))
                        ->flatten()
                        ->filter()
                        ->count();
                @endphp

                <!-- BUTTON FILTER -->
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

                    <form method="GET" action="{{ route('contact.messages.index') }}">

                        <!-- keep search value -->
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <label class="text-sm font-semibold">Status</label>

                        <div class="mt-2 space-y-2">

                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="status[]" value="replied"
                                    {{ in_array('replied', request('status', [])) ? 'checked' : '' }}>
                                Replied
                            </label>

                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="type[]" value="not_replied"
                                    {{ in_array('not_replied', request('status', [])) ? 'checked' : '' }}>
                                Not Replied
                            </label>

                        </div>

                        <div class="mt-4 flex gap-2">

                            <a href="{{ route('contact.messages.index') }}"
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
                            Name
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Date
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Email
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
                    @foreach ($messages as $message)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($message->user->profile_image)
                                        <img src="{{ asset('storage/' . $message->user->profile_image) }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center">
                                            <i class="fa-solid fa-circle-user text-4xl text-darkGreen"></i>
                                        </div>
                                    @endif
                                    <span class="font-semibold text-darkGrey text-sm">
                                        {{ $message->user->first_name }} {{ $message->user->last_name }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ app()->getLocale() === 'id' ? $message->created_at->format('d/m/Y') : $message->created_at->format('m/d/Y') }}
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $message->user->email }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center justify-center
               px-4 py-1 rounded-md text-xs font-medium
               {{ $message->replied_at ? 'bg-darkGreen/10 text-darkGreen' : 'bg-red/10 text-red' }}">

                                    {{ $message->replied_at ? 'Replied' : 'Not Replied' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('contact.messages.show', $message) }}"
                                    class="inline-flex items-center gap-2
          bg-lightGreen/50 text-darkGreen font-medium
          px-4 py-2 rounded-lg
          hover:bg-lightGreen/30 transition text-sm">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Reply
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-sm text-darkGrey mt-6">
            <span>Showing {{ $messages->firstItem() }}–{{ $messages->lastItem() }}
                of {{ $messages->total() }} entries</span>

            <!-- Pagination -->
            <div class="flex items-center gap-1">

                {{-- Previous --}}
                @if ($messages->onFirstPage())
                    <span
                        class="w-9 h-9 flex items-center justify-center 
                     border rounded-lg text-mediumGrey cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $messages->previousPageUrl() }}"
                        class="w-9 h-9 flex items-center justify-center 
                  border rounded-lg hover:bg-mediumGrey/10">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif


                {{-- Page Numbers --}}
                @php
                    $start = max($messages->currentPage() - 2, 1);
                    $end = min($messages->currentPage() + 2, $messages->lastPage());
                @endphp

                @foreach ($messages->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $messages->currentPage())
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
                @if ($messages->hasMorePages())
                    <a href="{{ $messages->nextPageUrl() }}"
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
