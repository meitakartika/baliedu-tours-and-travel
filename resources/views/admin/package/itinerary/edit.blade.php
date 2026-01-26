@extends('layout.admin')

@section('title', 'Edit Itinerary')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.itinerary.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Edit Itinerary
        </h1>

        <!-- FORM -->
        <form class="space-y-10">

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <h2 class="font-semibold text-base text-darkGrey mt-4">Tour Package</h2>
                <div class="md:col-span-2">
                    <div class="relative mt-1">
                        <input type="text" name="tour" placeholder="Select the tour package"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                            Tour Package
                        </label>
                    </div>
                </div>

                <hr class="border-2 border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Itinerary Details</h2>
                <!-- Name ID -->
                <div class="relative mt-1">
                    <input type="text" name="name-id" placeholder="Enter the indonesian name"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Name ID
                    </label>
                </div>

                <!-- Name EN -->
                <div class="relative mt-1">
                    <input type="text" name="name-en" placeholder="Enter the english name"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Name EN
                    </label>
                </div>

                <!-- Time -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="time" placeholder="Select the time"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Time
                        </label>
                    </div>
                </div>

                <!-- Description ID -->
                <div class="relative mt-2">
                    <textarea name="description-id" rows="4" placeholder="Enter the indonesian description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description ID
                    </label>
                </div>

                <!-- Description EN -->
                <div class="relative mt-2">
                    <textarea name="description-en" rows="4" placeholder="Enter the english description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description EN
                    </label>
                </div>

                <!-- ADD MORE DESCRIPTION -->
                <button type="button"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Description
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">

                <!-- ADD MORE DETAILS -->
                <div class="mt-4 md:col-span-2">
                    <label
                        class="flex items-center justify-center w-full
                   border border-dashed border-mediumGrey
                   rounded-xl h-40 cursor-pointer
                   text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">
                        <i class="fa-solid fa-plus text-xl"></i>
                        Add More Itinerary Details
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
                    Delete Itinerary
                </button>
            </div>

        </form>

    </section>
@endsection
