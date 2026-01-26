@extends('layout.admin')

@section('title', 'Edit List')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.list.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Edit List
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

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Includes List</h2>

                <!-- Content ID -->
                <div class="relative mt-2">
                    <textarea name="content-id" rows="4" placeholder="Enter the indonesian content"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Content ID
                    </label>
                </div>

                <!-- Content EN -->
                <div class="relative mt-2">
                    <textarea name="content-en" rows="4" placeholder="Enter the english content"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Content EN
                    </label>
                </div>

                <!-- ADD MORE DESCRIPTION -->
                <button type="button"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Description
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Not Includes List</h2>

                <!-- Content ID -->
                <div class="relative mt-2">
                    <textarea name="content-id" rows="4" placeholder="Enter the indonesian content"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Content ID
                    </label>
                </div>

                <!-- Content EN -->
                <div class="relative mt-2">
                    <textarea name="content-en" rows="4" placeholder="Enter the english content"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Content EN
                    </label>
                </div>

                <!-- ADD MORE DESCRIPTION -->
                <button type="button"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Description
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Must Bring List</h2>

                <!-- Content ID -->
                <div class="relative mt-2">
                    <textarea name="content-id" rows="4" placeholder="Enter the indonesian content"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Content ID
                    </label>
                </div>

                <!-- Content EN -->
                <div class="relative mt-2">
                    <textarea name="content-en" rows="4" placeholder="Enter the english content"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Content EN
                    </label>
                </div>

                <!-- ADD MORE DESCRIPTION -->
                <button type="button"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Description
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">
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
                    Delete List
                </button>
            </div>

        </form>

    </section>
@endsection
