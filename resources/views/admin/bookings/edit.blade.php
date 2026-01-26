@extends('layout.admin')

@section('title', 'View Booking')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('bookings.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            View Booking
        </h1>

        <!-- FORM -->
        <form class="space-y-10">

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Booking Details</h2>
                <!-- Tour -->
                <div class="relative mt-1">
                    <input type="text" name="tour" placeholder="Enter the tour"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Tour Package
                    </label>
                </div>

                <!-- Guests -->
                <div class="relative mt-1">
                    <input type="text" name="guests" placeholder="Enter the guests"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Number of Guests
                    </label>
                </div>

                <!-- From -->
                <div class="relative mt-1">
                    <input type="date" name="from" placeholder="Enter the from date"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        From
                    </label>
                </div>

                <!-- To -->
                <div class="relative mt-1">
                    <input type="date" name="to" placeholder="Enter the to date"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        To
                    </label>
                </div>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">User Details</h2>
                <!-- USER SECTION -->
                <div class="col-span-2 flex gap-8 items-center">

                    <!-- AVATAR -->
                    <div class="flex flex-col items-center gap-3 w-32">
                        <img src="/images/bali1.png" class="w-24 h-24 rounded-full object-cover" alt="User">
                    </div>

                    <!-- INPUTS -->
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- NAME -->
                        <div class="relative mt-4 col-span-2">
                            <input type="text" name="name" placeholder="Enter your name"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Name
                            </label>
                        </div>

                        <!-- EMAIL -->
                        <div class="relative mt-2">
                            <input type="email" name="email" placeholder="Enter your email"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Email
                            </label>
                        </div>

                        <!-- PHONE NUMBER -->
                        <div class="relative mt-2">
                            <input type="text" name="phone" placeholder="Enter your phone number"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Phone Number
                            </label>
                        </div>

                    </div>
                </div>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Payment</h2>
                <!-- TOTAL PRICE -->
                <div class="relative mt-2 col-span-2">
                    <input type="text" name="total" placeholder="Enter total price"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Total Price
                    </label>
                </div>

                <!-- Payment Proof -->
                <div class="mt-2">
                    <p class="text-sm text-darkGrey mb-3">
                        Payment Proof
                    </p>
                    <label
                        class="flex items-center justify-center w-full
                   border border-dashed border-mediumGrey
                   rounded-xl h-40 cursor-pointer
                   text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">
                        <i class="fa-solid fa-image text-xl"></i>
                        Drop image here or click to upload
                    </label>
                </div>

                <hr class="border-2 border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Booking Status</h2>
                <!-- STATUS -->
                <div class="relative mt-2">
                    <input type="text" name="status" placeholder="Select the status"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Status
                    </label>
                </div>
            </div>

            <!-- SUBMIT -->
            <div class="flex gap-4">
                <!-- SAVE BUTTON -->
                <button type="submit"
                    class="bg-darkGreen text-white text-sm font-medium
               px-12 md:px-16 py-3 rounded-lg
               hover:bg-darkGreen/90 transition">
                    Save
                </button>

                <!-- DELETE BUTTON -->
                <button type="button"
                    class="flex items-center gap-3
               bg-red text-white text-sm font-medium
               px-8 py-3 rounded-lg
               hover:bg-red/90 transition">
                    <i class="fa-solid fa-trash-alt"></i>
                    Delete Booking
                </button>
            </div>

        </form>

    </section>
@endsection
