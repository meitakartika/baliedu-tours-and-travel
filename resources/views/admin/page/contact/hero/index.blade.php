
@extends('layout.admin')

@section('title', 'Contact Hero')

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
            Contact Hero
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
        <form action="{{ route('page.contact.hero.update') }}" method="POST"
            enctype="multipart/form-data" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- TITLES -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- TITLE ID 1 -->
                <div class="relative mt-2">
                    <input type="text" name="title_id_1"
                        value="{{ old('title_id_1', $contactHero->title_id_1 ?? '') }}"
                        placeholder="Enter first Indonesian title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title 1 (ID)
                    </label>
                </div>

                <!-- TITLE ID 2 -->
                <div class="relative mt-2">
                    <input type="text" name="title_id_2"
                        value="{{ old('title_id_2', $contactHero->title_id_2 ?? '') }}"
                        placeholder="Enter second Indonesian title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title 2 (ID)
                    </label>
                </div>

                <!-- TITLE EN 1 -->
                <div class="relative mt-2">
                    <input type="text" name="title_en_1"
                        value="{{ old('title_en_1', $contactHero->title_en_1 ?? '') }}"
                        placeholder="Enter first English title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title 1 (EN)
                    </label>
                </div>

                <!-- TITLE EN 2 -->
                <div class="relative mt-2">
                    <input type="text" name="title_en_2"
                        value="{{ old('title_en_2', $contactHero->title_en_2 ?? '') }}"
                        placeholder="Enter second English title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title 2 (EN)
                    </label>
                </div>

            </div>

            <!-- EXISTING IMAGE -->
            <div>
                <p class="text-sm text-darkGrey mb-3">
                    Existing Hero Image
                </p>

                <div id="existing-image">

                    @if ($contactHero?->image)
                        <div class="relative w-full max-w-sm existing-image">

                            <img src="{{ asset('storage/' . $contactHero->image) }}"
                                alt="Contact Hero"
                                class="w-full h-40 object-cover rounded-lg shadow">

                            <button type="button"
                                onclick="removeOldImage(this, '{{ addslashes($contactHero->image) }}')"
                                class="absolute -top-2 -right-2 bg-red text-white w-6 h-6 rounded-full text-xs">
                                ✕
                            </button>

                        </div>
                    @else
                        <p class="text-sm text-mediumGrey">
                            No image available.
                        </p>
                    @endif

                </div>
            </div>

            <!-- ADD IMAGE -->
            <div>
                <p class="text-sm text-darkGrey mb-3">
                    Change Hero Image
                </p>

                <label
                    class="flex items-center justify-center w-full border border-dashed border-mediumGrey rounded-xl h-40 cursor-pointer text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">

                    <input type="file" name="image" id="image"
                        accept="image/jpeg,image/png,image/webp" class="hidden">

                    <i class="fa-solid fa-image text-xl"></i>
                    Click to upload image
                </label>

                <!-- SELECTED IMAGE PREVIEW -->
                <div id="selected-image" class="mt-4 hidden">
                    <img id="image-preview"
                        class="w-full max-w-sm h-40 object-cover rounded-lg shadow">
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

@push('scripts')
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const selectedImage = document.getElementById('selected-image');

        // Preview new image
        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                selectedImage.classList.remove('hidden');
            } else {
                selectedImage.classList.add('hidden');
            }
        });

        // Remove existing image
        function removeOldImage(btn, image) {

            btn.parentElement.remove();

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_image';
            input.value = '1';

            document.querySelector('form[action="{{ route('page.contact.hero.update') }}"]')
                .appendChild(input);
        }
    </script>
@endpush
