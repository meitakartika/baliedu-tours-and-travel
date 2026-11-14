@extends('layout.admin')

@section('title', __('admin.page_slide'))

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
            Hero / Slideshow
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

        <!-- FORM -->
        <form action="{{ route('page.slide.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- DESCRIPTIONS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Description ID -->
                <div class="relative mt-2">
                    <textarea name="description_id" rows="5" placeholder="Enter Indonesian description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                        required>{{ old('description_id', $heroSlide->description_id ?? '') }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (ID)
                    </label>
                </div>

                <!-- Description EN -->
                <div class="relative mt-2">
                    <textarea name="description_en" rows="5" placeholder="Enter English description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                        required>{{ old('description_en', $heroSlide->description_en ?? '') }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (EN)
                    </label>
                </div>

            </div>

            <!-- EXISTING IMAGES -->
            <div>
                <p class="text-sm text-darkGrey mb-3">
                    Existing Slideshow Images
                </p>

                <div id="existing-images" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

                    @forelse ($heroSlide->images ?? [] as $image)
                        <div class="relative existing-image">

                            <img src="{{ asset('storage/' . $image) }}" alt="Hero Image"
                                class="w-full h-28 object-cover rounded-lg shadow">

                            <button type="button" onclick="removeOldImage(this, '{{ addslashes($image) }}')"
                                class="absolute -top-2 -right-2 bg-red text-white w-6 h-6 rounded-full text-xs">
                                ✕
                            </button>

                        </div>
                    @empty
                        <p class="text-sm text-mediumGrey col-span-full">
                            No images available.
                        </p>
                    @endforelse

                </div>
            </div>

            <!-- ADD IMAGES -->
            <div>
                <p class="text-sm text-darkGrey mb-3">
                    Add Slideshow Images
                </p>

                <label
                    class="flex items-center justify-center w-full border border-dashed border-mediumGrey rounded-xl h-40 cursor-pointer text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">

                    <input type="file" name="new_images[]" id="new_images" accept="image/jpeg,image/png"
                        multiple class="hidden">

                    <i class="fa-solid fa-image text-xl"></i>Click to upload images
                </label>

                <!-- SELECTED IMAGE PREVIEW -->
                <div id="selected-images" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
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
        // Selected Images Preview
        const imageInput = document.getElementById('new_images');
        const imagePreview = document.getElementById('selected-images');

        let selectedFiles = [];

        // Update input files
        function updateInputFiles() {
            const dt = new DataTransfer();

            selectedFiles.forEach(file => {
                dt.items.add(file);
            });

            imageInput.files = dt.files;
        }

        // Render selected images
        function renderPreview() {

            imagePreview.innerHTML = '';

            selectedFiles.forEach((file, index) => {

                const wrapper = document.createElement('div');
                wrapper.className = 'relative';

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'w-full h-28 object-cover rounded-lg shadow';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '✕';
                removeBtn.className =
                    'absolute -top-2 -right-2 bg-mediumGrey text-white w-6 h-6 rounded-full text-xs';

                removeBtn.onclick = () => {

                    selectedFiles.splice(index, 1);

                    updateInputFiles();
                    renderPreview();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);

                imagePreview.appendChild(wrapper);

            });
        }

        // Select new images
        imageInput.addEventListener('change', function() {

            const files = Array.from(this.files);

            selectedFiles = [...selectedFiles, ...files];

            updateInputFiles();
            renderPreview();

        });

        // Remove existing image
        function removeOldImage(btn, image) {

            btn.parentElement.remove();

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_images[]';
            input.value = image;

            document.querySelector('form[action="{{ route('page.slide.update') }}"]')
                .appendChild(input);

        }
    </script>
@endpush
