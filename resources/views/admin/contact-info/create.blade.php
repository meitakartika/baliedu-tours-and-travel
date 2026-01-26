@extends('layout.admin')

@section('title', 'Add New Contact')

@section('content')
    <section class="w-full">

    <!-- BACK -->
    <a href="{{ route('contact.info.index') }}"
       class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>

    <!-- TITLE -->
    <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
        Add New Contact
    </h1>

    <!-- FORM -->
    <form class="space-y-10">

        <!-- INPUTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Type -->
            <div class="relative mt-4">
                    <input type="text" name="type" placeholder="Enter contact type"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Type
                    </label>
                </div>

            <!-- Label -->
            <div class="relative mt-4">
                    <input type="text" name="label" placeholder="Enter contact label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (Optional)
                    </label>
                </div>

            <!-- Value -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="value" placeholder="Enter contact value"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Value
                    </label>
                </div>
            </div>
        </div>

        <!-- SUBMIT -->
        <button
            class="bg-darkGreen text-white text-sm font-medium
                   px-12 py-3 rounded-lg w-1/2 lg:w-1/3
                   hover:bg-darkGreen/90 transition">
            Add New
        </button>

    </form>

    </section>
@endsection