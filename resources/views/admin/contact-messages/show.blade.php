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

        <!-- FORM -->
        <form class="space-y-10">

            <!-- TOP SECTION -->
            <div class="flex gap-8 items-start">

                <!-- AVATAR -->
                <div class="flex flex-col items-center gap-3 w-32">
                    <img src="/images/bali1.png" class="w-24 h-24 rounded-full object-cover" alt="User">

                    <span class="text-xs text-mediumGrey">
                        12 Desember 2025
                    </span>
                </div>

                <!-- INPUTS -->
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NAME -->
                    <div class="relative mt-4">
                        <input type="text" name="name" placeholder="Enter your first name"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Name
                        </label>
                    </div>

                    <!-- EMAIL -->
                    <div class="relative mt-4">
                        <input type="email" name="email" placeholder="Enter your email"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Email
                        </label>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="phone" placeholder="Enter your phone number"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Phone Number
                    </label>
                </div>
            </div>

                </div>
            </div>

            <!-- MESSAGE -->
            <div class="relative mt-2">
                <textarea name="message" rows="7"
                    placeholder="Share your experience with us... What did you enjoy most? Would you recommend us to others?"
                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen"></textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                    Message
                </label>
            </div>

            <!-- MESSAGE -->
            <div class="relative mt-2">
                <textarea name="message" rows="7"
                    placeholder="Type your reply message here…"
                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen"></textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                    Reply Message
                </label>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-4 mt-8">

                <!-- SAVE -->
                <button type="submit"
                    class="flex items-center gap-3
                            bg-darkGreen text-white text-sm font-medium
                           px-12 md:px-16 py-3 rounded-lg
                           hover:bg-darkGreen/90 transition">
                           <i class="fa-solid fa-paper-plane"></i>
                    Send
                </button>

                <!-- DELETE -->
                <button type="button"
                    class="flex items-center gap-3
                           bg-red text-white text-sm font-medium
                           px-8 py-3 rounded-lg
                           hover:bg-red/90 transition">
                    <i class="fa-solid fa-trash-alt"></i>
                    Delete Message
                </button>
            </div>

        </form>

    </section>
@endsection
