@extends('layout.admin')

@section('title', 'Discover Section')

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
            Discover Section
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

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
            <div class="rounded-lg bg-green/5 border border-green-600 p-4 text-green-700 text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('page.discover.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- CONTENT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LABEL -->
                <div class="relative mt-2">
                    <input type="text" name="label_id" value="{{ old('label_id', $discoverSection->label_id) }}"
                        placeholder="Enter Indonesian label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (ID)
                    </label>
                </div>

                <div class="relative mt-2">
                    <input type="text" name="label_en" value="{{ old('label_en', $discoverSection->label_en) }}"
                        placeholder="Enter English label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (EN)
                    </label>
                </div>

                <!-- TITLE -->
                <div class="relative mt-2">
                    <input type="text" name="title_id" value="{{ old('title_id', $discoverSection->title_id) }}"
                        placeholder="Enter Indonesian title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (ID)
                    </label>
                </div>

                <div class="relative mt-2">
                    <input type="text" name="title_en" value="{{ old('title_en', $discoverSection->title_en) }}"
                        placeholder="Enter English title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (EN)
                    </label>
                </div>

                <!-- DESCRIPTION -->
                <div class="relative mt-2">
                    <textarea name="description_id" rows="5" placeholder="Enter Indonesian description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                        required>{{ old('description_id', $discoverSection->description_id) }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (ID)
                    </label>
                </div>

                <div class="relative mt-2">
                    <textarea name="description_en" rows="5" placeholder="Enter English description"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                        required>{{ old('description_en', $discoverSection->description_en) }}</textarea>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (EN)
                    </label>
                </div>

                <!-- BUTTON TEXT -->
                <div class="relative mt-2">
                    <input type="text" name="button_id" value="{{ old('button_id', $discoverSection->button_id) }}"
                        placeholder="Enter Indonesian button text"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Button Text (ID)
                    </label>
                </div>

                <div class="relative mt-2">
                    <input type="text" name="button_en" value="{{ old('button_en', $discoverSection->button_en) }}"
                        placeholder="Enter English button text"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Button Text (EN)
                    </label>
                </div>

            </div>

            <!-- DIVIDER -->
            <hr class="border-mediumGrey">

            <!-- EXISTING IMAGES -->
            <div>
                <p class="text-sm text-darkGrey mb-3">
                    Existing Discover Images
                </p>

                <div id="existing-images" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

                    @foreach ([
            'image_1' => $discoverSection->image_1,
            'image_2' => $discoverSection->image_2,
            'image_3' => $discoverSection->image_3,
        ] as $field => $image)
                        @if ($image)
                            <div class="relative existing-image">
                                <img src="{{ asset('storage/' . $image) }}" alt="Discover Image"
                                    class="w-full h-28 object-cover rounded-lg shadow">

                                <button type="button"
                                    onclick="removeOldImage(this, '{{ $field }}', '{{ addslashes($image) }}')"
                                    class="absolute -top-2 -right-2 bg-red text-white w-6 h-6 rounded-full text-xs">
                                    ✕
                                </button>
                            </div>
                        @endif
                    @endforeach

                    @if (!$discoverSection->image_1 && !$discoverSection->image_2 && !$discoverSection->image_3)
                        <p class="text-sm text-mediumGrey col-span-full">
                            No images available.
                        </p>
                    @endif

                </div>
            </div>

            <!-- ADD / REPLACE IMAGES -->
            <div>
                <p class="text-sm text-darkGrey mb-3">
                    Add / Replace Discover Images
                </p>

                <p class="text-xs text-mediumGrey mb-3">
                    You can upload a maximum of 3 images.
                </p>

                <label
                    class="flex items-center justify-center w-full border border-dashed border-mediumGrey rounded-xl h-40 cursor-pointer text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">

                    <input type="file" name="images[]" id="new_images" accept="image/jpeg,image/png,image/webp" multiple
                        class="hidden">

                    <i class="fa-solid fa-image text-xl"></i>
                    Click to upload images
                </label>

                <!-- SELECTED IMAGE PREVIEW -->
                <div id="selected-images" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
                </div>

                <p id="image-limit-error" class="text-red text-xs mt-2 hidden">
                    Maximum 3 images allowed.
                </p>

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
        const imageInput = document.getElementById('new_images');
        const imagePreview = document.getElementById('selected-images');
        const imageLimitError = document.getElementById('image-limit-error');

        let selectedFiles = [];

        // Count remaining existing images
        function getExistingImageCount() {
            return document.querySelectorAll(
                '#existing-images .existing-image'
            ).length;
        }

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

            const availableSlots = Math.max(
                0,
                3 - getExistingImageCount() - selectedFiles.length
            );

            const acceptedFiles = files.slice(0, availableSlots);

            selectedFiles = [...selectedFiles, ...acceptedFiles];

            if (files.length > availableSlots) {
                imageLimitError.textContent = availableSlots > 0 ?
                    `Only ${availableSlots} additional image(s) can be uploaded.` :
                    'Maximum 3 images already reached.';

                imageLimitError.classList.remove('hidden');
            } else {
                imageLimitError.classList.add('hidden');
            }

            updateInputFiles();
            renderPreview();

        });

        // Remove existing image
        function removeOldImage(btn, field, image) {
            btn.parentElement.remove();

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_images[]';
            input.value = field;

            document.querySelector('form[action="{{ route('page.discover.update') }}"]')
                .appendChild(input);

            imageLimitError.classList.add('hidden');
        }
    </script>
@endpush
