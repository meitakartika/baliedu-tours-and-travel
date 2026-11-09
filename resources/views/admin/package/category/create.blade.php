@extends('layout.admin')

@section('title', __('admin.add_new_category'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.category.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.add_new_category') }}
        </h1>

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
            <div class="rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('package.category.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name ID -->
                <div class="relative mt-4">
                    <input type="text" name="name_id" placeholder="{{ __('admin.enter_indonesian_name') }}"
                        value="{{ old('name_id', $category->name_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (ID)
                    </label>
                </div>

                <!-- Name EN -->
                <div class="relative mt-4">
                    <input type="text" name="name_en" placeholder="{{ __('admin.enter_english_name') }}"
                        value="{{ old('name_en', $category->name_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (EN)
                    </label>
                </div>

                <!-- Description ID -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="description_id"
                            placeholder="{{ __('admin.enter_indonesian_description') }}"
                            value="{{ old('description_id', $category->description_id) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description') }} (ID)
                        </label>
                    </div>
                </div>

                <!-- Description EN -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="description_en"
                            placeholder="{{ __('admin.enter_english_description') }}"
                            value="{{ old('description_en', $category->description_en) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description') }} (EN)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Category Image -->
            <div class="md:col-span-2 mt-2">
                <p class="text-sm text-darkGrey mb-3">
                    Category Image
                </p>

                <label
                    class="flex items-center justify-center w-full
        border border-dashed border-mediumGrey
        rounded-xl h-40 cursor-pointer
        text-sm text-mediumGrey hover:border-darkGreen
        hover:text-darkGreen gap-2">

                    <input type="file" name="image" id="categoryImage" accept="image/jpeg,image/png" class="hidden">

                    <i class="fa-solid fa-image text-xl"></i>
                    Click to upload image
                </label>

                <!-- IMAGE PREVIEW -->
                <div id="imagePreview" class="mt-4 hidden">
                    <div class="relative w-40">
                        <img id="previewImg" class="w-full h-28 object-cover rounded-lg shadow">

                        <button type="button" id="removeImage"
                            class="absolute -top-2 -right-2 bg-red text-white w-6 h-6 rounded-full text-xs">
                            ✕
                        </button>
                    </div>
                </div>
            </div>

            <!-- SUBMIT -->
            <button
                class="bg-darkGreen text-white text-sm font-medium
                   px-12 py-3 rounded-lg w-1/2 lg:w-1/3
                   hover:bg-darkGreen/90 transition">
                {{ __('admin.add_new') }}
            </button>

        </form>

    </section>
@endsection

@push('scripts')
    <script>
        const imageInput = document.getElementById('categoryImage');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImage = document.getElementById('removeImage');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                previewImg.src = URL.createObjectURL(file);
                imagePreview.classList.remove('hidden');
            }
        });

        removeImage.addEventListener('click', function() {
            imageInput.value = '';
            previewImg.src = '';
            imagePreview.classList.add('hidden');
        });
    </script>
@endpush
