@extends('layout.admin')

@section('title', 'Edit Type')

@section('content')
    <section class="w-full">

    <!-- BACK -->
    <a href="{{ route('package.type.index') }}"
       class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>

    <!-- TITLE -->
    <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
        Edit Type
    </h1>

    <!-- FORM -->
    <form class="space-y-10">

        <!-- INPUTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Category -->
            <div class="md:col-span-2">
                <div class="relative mt-4">
                    <input type="text" name="category" placeholder="Select the category"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Category
                    </label>
                </div>
            </div>

            <!-- Name ID -->
            <div class="relative mt-2">
                    <input type="text" name="name-id" placeholder="Enter the indonesian name"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Name ID
                    </label>
                </div>

            <!-- Name EN -->
            <div class="relative mt-2">
                    <input type="text" name="name-en" placeholder="Enter the english name"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Name EN
                    </label>
                </div>

            <!-- Description ID -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="description-id" placeholder="Enter the indonesian description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description ID (Optional)
                    </label>
                </div>
            </div>

            <!-- Description EN -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="description-en" placeholder="Enter the english description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description EN (Optional)
                    </label>
                </div>
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
                    Delete Type
                </button>
            </div>

    </form>

    </section>
@endsection