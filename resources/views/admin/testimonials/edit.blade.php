@extends('layout.admin')

@section('title', 'Edit Testimonial')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('customers.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Edit Testimonial
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

                    <!-- TOUR PACKAGE -->
                    <div class="relative mt-2">
                        <input type="text" name="tour" placeholder="Enter your tour package"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Tour Package
                        </label>
                    </div>

                    <!-- RATING -->
                    <div class="relative mt-2">
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Rating
                        </label>

                        <div
                            class="bg-softGrey w-full rounded-md h-12
               flex items-center px-4 pt-4 gap-2
               text-2xl text-gray-300">

                            <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
                            <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
                            <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
                            <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
                            <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
                        </div>
                    </div>

                </div>
            </div>

            <!-- TESTIMONIAL -->
            <div class="relative mt-2">
                <textarea name="message" rows="7"
                    placeholder="Share your experience with us... What did you enjoy most? Would you recommend us to others?"
                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen"></textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                    Testimonial
                </label>
            </div>

            <!-- CURRENT IMAGE -->
            <div>
                <p class="text-sm font-medium text-darkGrey mb-3">
                    Current Image Review
                </p>

                <div class="w-40 flex flex-col items-center">
                    <img src="/images/bali1.png" class="rounded-xl object-cover mb-2">

                    <button type="button" class="text-xs text-red hover:text-red/90">
                        Remove Image
                    </button>
                </div>
            </div>

            <!-- REPLACE IMAGE -->
            <div>
                <p class="text-sm font-medium text-darkGrey mb-3">
                    Replace Image Review
                </p>

                <label
                    class="flex flex-col items-center justify-center
                       border border-dashed border-mediumGrey
                       rounded-xl h-40 cursor-pointer
                       text-sm text-mediumGrey hover:border-darkGreen">
                    <i class="fa-regular fa-image text-xl mb-2"></i>
                    Drop image here or click to upload
                    <input type="file" class="hidden">
                </label>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-4 mt-8">

                <!-- SAVE -->
                <button type="submit"
                    class="bg-darkGreen text-white text-sm font-medium
                           px-12 md:px-16 py-3 rounded-lg
                           hover:bg-darkGreen/90 transition">
                    Save
                </button>

                <!-- DELETE -->
                <button type="button"
                    class="flex items-center gap-3
                           bg-red text-white text-sm font-medium
                           px-8 py-3 rounded-lg
                           hover:bg-red/90 transition">
                    <i class="fa-solid fa-trash"></i>
                    Delete Testimonial
                </button>
            </div>

        </form>

    </section>
@endsection
