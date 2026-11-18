
@extends('layout.admin')

@section('title', 'Contact Heading')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('page.contact.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Contact Heading
        </h1>

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
            <div class="rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm mb-6">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- SUCCESS -->
        @if (session('success'))
            <div class="rounded-lg bg-lightGreen/20 border border-darkGreen/30 p-4 text-darkGreen text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('page.contact.heading.update') }}"
            method="POST" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Label ID -->
                <div class="relative mt-4">
                    <input type="text" name="label_id"
                        value="{{ old('label_id', $contactHeading?->label_id ?? '') }}"
                        placeholder="Enter label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (ID)
                    </label>
                </div>

                <!-- Label EN -->
                <div class="relative mt-4">
                    <input type="text" name="label_en"
                        value="{{ old('label_en', $contactHeading?->label_en ?? '') }}"
                        placeholder="Enter label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (EN)
                    </label>
                </div>

                <!-- Title ID -->
                <div class="relative mt-2">
                    <input type="text" name="title_id"
                        value="{{ old('title_id', $contactHeading?->title_id ?? '') }}"
                        placeholder="Enter title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (ID)
                    </label>
                </div>

                <!-- Title EN -->
                <div class="relative mt-2">
                    <input type="text" name="title_en"
                        value="{{ old('title_en', $contactHeading?->title_en ?? '') }}"
                        placeholder="Enter title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (EN)
                    </label>
                </div>

                <!-- Description ID -->
                <div class="relative mt-2">
                    <textarea name="description_id" rows="5"
                        placeholder="Enter description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                        required>{{ old('description_id', $contactHeading?->description_id ?? '') }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (ID)
                    </label>
                </div>

                <!-- Description EN -->
                <div class="relative mt-2">
                    <textarea name="description_en" rows="5"
                        placeholder="Enter description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                        required>{{ old('description_en', $contactHeading?->description_en ?? '') }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (EN)
                    </label>
                </div>

            </div>

            <!-- SUBMIT -->
            <button type="submit"
                class="bg-darkGreen text-white text-sm font-medium px-12 py-3 rounded-lg w-1/2 lg:w-1/3 hover:bg-darkGreen/90 transition">
                {{ __('admin.save') }}
            </button>

        </form>

    </section>
@endsection
