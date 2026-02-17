@extends('layout.admin')

@section('title', 'Reply Message')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('contact.messages.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Reply Message
        </h1>

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
            <div class="rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('contact.messages.reply', $contactMessage) }}" class="space-y-10">
            @csrf

            <!-- TOP SECTION -->
            <div class="flex gap-8 items-start">

                <!-- AVATAR -->
                <div class="flex flex-col items-center gap-3 w-32">
                    @if ($contactMessage->user->profile_image)
                        <img src="{{ asset('storage/' . $contactMessage->user->profile_image) }}"
                            class="w-24 h-24 rounded-full object-cover">
                    @else
                        <div class="w-24 h-24 rounded-full flex items-center justify-center bg-mediumGrey/10">
                            <i class="fa-solid fa-circle-user text-8xl text-darkGreen"></i>
                        </div>
                    @endif

                    <span class="text-xs text-mediumGrey">
                        {{ app()->getLocale() === 'id'
                            ? $contactMessage->created_at->translatedFormat('d F Y')
                            : $contactMessage->created_at->format('d F Y') }}
                    </span>
                </div>

                <!-- INPUTS -->
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NAME -->
                    <div class="relative mt-4">
                        <input type="text" name="name"
                            value="{{ $contactMessage->user->first_name }} {{ $contactMessage->user->last_name }}" readonly
                            class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 cursor-not-allowed" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Name
                        </label>
                    </div>

                    <!-- EMAIL -->
                    <div class="relative mt-4">
                        <input type="email" name="email" value="{{ $contactMessage->user->email }}" readonly
                            class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 cursor-not-allowed" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Email
                        </label>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div class="md:col-span-2">
                        <div class="relative mt-2">
                            <input type="text" name="phone" value="{{ $contactMessage->user->phone }}" readonly
                                class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 cursor-not-allowed" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Phone Number
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- MESSAGE -->
            <div class="relative mt-2">
                <textarea name="message" rows="7" readonly
                    class="bg-softGrey w-full border border-darkGreen rounded-md px-3 pt-4 text-sm cursor-not-allowed">{{ $contactMessage->message }}</textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                    Message
                </label>
            </div>

            <!-- MESSAGE -->
            @php
                $isReplied = !empty($contactMessage->reply_message);
            @endphp
            <div class="relative mt-2">
                <textarea name="reply_message" rows="7" placeholder="Type your reply message here…"
                    {{ $isReplied ? 'readonly' : '' }}
                    class="bg-softGrey w-full border rounded-md px-3 pt-4 text-sm {{ $isReplied ? 'cursor-not-allowed border-darkGreen' : 'border-mediumGrey focus:outline-none focus:border-darkGreen' }}">{{ $contactMessage->reply_message }}</textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                    Reply Message
                </label>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-4 mt-8">

                <!-- SAVE -->
                <button type="submit" {{ $contactMessage->replied_at ? 'disabled' : '' }}
                    class="flex items-center gap-3
                            bg-darkGreen text-white text-sm font-medium
                           px-12 md:px-16 py-3 rounded-lg transition
                           {{ $contactMessage->replied_at ? 'opacity-50 cursor-not-allowed' : 'hover:bg-darkGreen/90' }}">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send
                </button>
        </form>

        <form id="deleteMessages" action="{{ route('contact.messages.destroy', $contactMessage) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="button" onclick="confirmDelete('deleteMessages', 'Delete Message?')"
                class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                Delete Message
            </button>
        </form>
        </div>

    </section>
@endsection
