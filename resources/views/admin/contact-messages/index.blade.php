@extends('layout.admin')

@section('title', 'Contact Messages')

@section('content')
    <section class="w-full">

        <!-- TOP ACTION -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Search -->
            <div class="w-full md:max-w-md">
                <input type="text" placeholder="Search for users/email"
                    class="w-full rounded-2xl border border-mediumGrey/20 bg-mediumGrey/5 px-5 py-3 text-sm
                       focus:outline-none">
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
                            Email
                            <i class="fa-solid fa-sort ml-2 text-xs"></i>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y border-b border-mediumGrey/20">
                    @php
                        $messages = [
                            [
                                'name' => 'Esthera Jackson',
                                'email' => 'esthera@simmpple.com',
                                'img' => 'https://i.pravatar.cc/100?img=1',
                            ],
                            [
                                'name' => 'Alexa Liras',
                                'email' => 'alexa@simmpple.com',
                                'img' => 'https://i.pravatar.cc/100?img=2',
                            ],
                            [
                                'name' => 'Laurent Michael',
                                'email' => 'laurent@simmpple.com',
                                'img' => 'https://i.pravatar.cc/100?img=3',
                            ],
                        ];
                    @endphp

                    @foreach ($messages as $message)
                        <tr class="hover:bg-mediumGrey/5">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $message['img'] }}" class="w-10 h-10 rounded-full object-cover"
                                        alt="{{ $message['name'] }}">
                                    <span class="font-semibold text-darkGrey text-sm">
                                        {{ $message['name'] }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-darkGrey text-sm">
                                {{ $message['email'] }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('contact.messages.show') }}"
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
            <span>Showing 1–3 of 3 entries</span>

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
