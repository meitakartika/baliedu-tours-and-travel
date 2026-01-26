@extends('layout.admin')

@section('title', 'EditPackage')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.tour.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Edit Package
        </h1>

        <!-- FORM -->
        <form class="space-y-10">

            <!-- IMAGE -->
            <div class="flex justify-center">
                <label class="relative cursor-pointer">
                    <input type="file" class="hidden">
                    <div
                        class="w-36 h-32 rounded-xl bg-mediumGrey/10
                           flex items-center justify-center">
                        <i class="fa-regular fa-image text-3xl text-darkGrey"></i>
                    </div>
                </label>
            </div>

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <div class="relative mt-4">
                    <input type="text" name="category" placeholder="Select the category"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Category
                    </label>
                </div>

                <!-- Type -->
                <div class="relative mt-4">
                    <input type="text" name="type" placeholder="Select the type"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Type
                    </label>
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

                <!-- Overview ID -->
                <div class="relative mt-2">
                    <textarea name="overview-id" rows="4" placeholder="Enter the indonesian overview"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Overview ID
                    </label>
                </div>

                <!-- Overview EN -->
                <div class="relative mt-2">
                    <textarea name="overview-en" rows="4" placeholder="Enter the english overview"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Overview EN
                    </label>
                </div>

                <!-- Price -->
                <div class="relative mt-2">
                    <input type="text" name="price" placeholder="Enter the price"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Price
                    </label>
                </div>

                <!-- Duration -->
                <div class="relative mt-2">
                    <input type="text" name="duration" placeholder="Enter the duration"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Duration (Days)
                    </label>
                </div>

                <!-- Guest Minimal -->
                <div class="relative mt-2">
                    <input type="text" name="guest-min" placeholder="Enter the guest minimal"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Guest Minimal
                    </label>
                </div>

                <!-- Guest Maximal -->
                <div class="relative mt-2">
                    <input type="text" name="guest-max" placeholder="Enter the guest maximal"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Guest Maximal
                    </label>
                </div>

                <!-- Tour Gallery -->
                <div class="mt-3 md:col-span-2">
                    <p class="text-sm text-darkGrey mb-3">
                        Tour Gallery
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
                    Delete Package
                </button>
            </div>

        </form>

    </section>
@endsection
