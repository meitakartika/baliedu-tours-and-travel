
@extends('layout.admin')

@section('title', 'Gallery Section')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('page.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Gallery Section
        </h1>

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
            <div class="rounded-lg bg-green/5 border border-green-600 p-4 text-green-700 text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

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

        <!-- FORM -->
        <form action="{{ route('page.gallery.update') }}" method="POST" class="space-y-10">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LABEL ID -->
                <div class="relative mt-2">
                    <input type="text" name="label_id"
                        value="{{ old('label_id', $gallerySection->label_id) }}"
                        placeholder="Enter Indonesian label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (ID)
                    </label>
                </div>

                <!-- LABEL EN -->
                <div class="relative mt-2">
                    <input type="text" name="label_en"
                        value="{{ old('label_en', $gallerySection->label_en) }}"
                        placeholder="Enter English label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (EN)
                    </label>
                </div>

                <!-- TITLE ID -->
                <div class="relative mt-2">
                    <input type="text" name="title_id"
                        value="{{ old('title_id', $gallerySection->title_id) }}"
                        placeholder="Enter Indonesian title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (ID)
                    </label>
                </div>

                <!-- TITLE EN -->
                <div class="relative mt-2">
                    <input type="text" name="title_en"
                        value="{{ old('title_en', $gallerySection->title_en) }}"
                        placeholder="Enter English title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (EN)
                    </label>
                </div>

                <!-- DESCRIPTION ID -->
                <div class="relative mt-2">
                    <textarea name="description_id" rows="5"
                        placeholder="Enter Indonesian description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen">{{ old('description_id', $gallerySection->description_id) }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (ID)
                    </label>
                </div>

                <!-- DESCRIPTION EN -->
                <div class="relative mt-2">
                    <textarea name="description_en" rows="5"
                        placeholder="Enter English description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen">{{ old('description_en', $gallerySection->description_en) }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (EN)
                    </label>
                </div>

                <!-- BUTTON ID -->
                <div class="relative mt-2">
                    <input type="text" name="button_id"
                        value="{{ old('button_id', $gallerySection->button_id) }}"
                        placeholder="Enter Indonesian button text"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Button Text (ID)
                    </label>
                </div>

                <!-- BUTTON EN -->
                <div class="relative mt-2">
                    <input type="text" name="button_en"
                        value="{{ old('button_en', $gallerySection->button_en) }}"
                        placeholder="Enter English button text"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Button Text (EN)
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
