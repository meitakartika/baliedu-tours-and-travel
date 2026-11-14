@extends('layout.admin')

@section('title', 'Page')

@section('content')
    <section class="w-full">

        <!-- TABLE -->
        <div class="bg-softGrey overflow-x-auto">
            <table class="w-full min-w-[720px]">

                <thead class="bg-mediumGrey/10 text-darkGrey">
                    <tr>
                        <th class="text-left px-6 py-4 font-semibold text-sm whitespace-nowrap">
                            Section
                        </th>

                        <th class="px-6 py-4 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y border-b border-mediumGrey/20">

                    @foreach ($sections as $section)
                        <tr class="hover:bg-mediumGrey/5">

                            <!-- Section Name -->
                            <td class="px-6 py-4 text-darkGrey text-sm font-medium">
                                {{ $section['name'] }}
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 text-right">
                                @if ($section['key'] === 'slide')
                                    <a href="{{ route('page.slide.index') }}"
                                        class="inline-flex items-center gap-2 bg-lightGreen/50 text-darkGreen font-medium px-4 py-2 rounded-lg hover:bg-lightGreen/30 transition text-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Manage
                                    </a>
                                @elseif ($section['key'] === 'category')
                                    <a href="{{ route('page.category.index') }}"
                                        class="inline-flex items-center gap-2 bg-lightGreen/50 text-darkGreen font-medium px-4 py-2 rounded-lg hover:bg-lightGreen/30 transition text-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Manage
                                    </a>
                                @elseif ($section['key'] === 'statistics')
                                    <a href="{{ route('page.statistics.index') }}"
                                        class="inline-flex items-center gap-2 bg-lightGreen/50 text-darkGreen font-medium px-4 py-2 rounded-lg hover:bg-lightGreen/30 transition text-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Manage
                                    </a>
                                @elseif ($section['key'] === 'discover')
                                    <a href="{{ route('page.discover.index') }}"
                                        class="inline-flex items-center gap-2 bg-lightGreen/50 text-darkGreen font-medium px-4 py-2 rounded-lg hover:bg-lightGreen/30 transition text-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Manage
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </section>
@endsection
