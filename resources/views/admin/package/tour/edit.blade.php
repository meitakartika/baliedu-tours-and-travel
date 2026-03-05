@extends('layout.admin')

@section('title', __('admin.edit_package'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.tour.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.edit_package') }}
        </h1>

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
        <form id="updateForm" action="{{ route('package.tour.update', $package) }}" method="POST"
            enctype="multipart/form-data" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- IMAGE -->
            <div class="flex justify-center">
                <label class="relative cursor-pointer">
                    <input type="file" name="image_url" id="mainImage" class="hidden">
                    <div id="mainPreview"
                        class="w-36 h-32 rounded-xl bg-mediumGrey/10
                           flex items-center justify-center overflow-hidden">
                        <img src="{{ $package->image_url ? asset('storage/' . $package->image_url) : '' }}"
                            class="w-full h-full object-cover {{ $package->image_url ? '' : 'hidden' }}"
                            id="mainPreviewImg">

                        <i id="mainIcon"
                            class="fa-regular fa-image text-3xl text-darkGrey {{ $package->image_url ? 'hidden' : '' }}"></i>
                    </div>
                </label>
            </div>

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <div class="relative mt-4">
                    <select name="category_id" id="category"
                        class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey"
                        required>

                        <option value="" disabled selected hidden>
                            {{ __('admin.select_category') }}
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $package->category_id) == $category->id ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}
                            </option>
                        @endforeach

                    </select>

                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </span>

                    <label
                        class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                        {{ __('admin.category') }}
                    </label>
                </div>

                <!-- Type -->
                <div class="relative mt-4">
                    <select name="type_id" id="type" disabled
                        class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey">

                        <option>{{ __('admin.select_category_first') }}</option>

                    </select>

                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </span>

                    <label
                        class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                        {{ __('admin.type') }}
                    </label>
                </div>

                <!-- Name ID -->
                <div class="relative mt-2">
                    <input type="text" name="name_id" placeholder="{{ __('admin.enter_indonesian_name') }}"
                        value="{{ old('name_id', $package->name_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (ID)
                    </label>
                </div>

                <!-- Name EN -->
                <div class="relative mt-2">
                    <input type="text" name="name_en" placeholder="{{ __('admin.enter_english_name') }}"
                        value="{{ old('name_en', $package->name_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (EN)
                    </label>
                </div>

                <!-- Overview ID -->
                <div class="relative mt-2">
                    <textarea name="overview_id" rows="4" placeholder="{{ __('admin.enter_overview_id') }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen">{{ old('overview_id', $package->overview_id) }}</textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.overview') }} (ID)
                    </label>
                </div>

                <!-- Overview EN -->
                <div class="relative mt-2">
                    <textarea name="overview_en" rows="4" placeholder="{{ __('admin.enter_overview_en') }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen">{{ old('overview_en', $package->overview_en) }}</textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.overview') }} (EN)
                    </label>
                </div>

                <!-- Price -->
                <div class="relative mt-2">

                    <!-- INPUT TAMPILAN -->
                    <input type="text" id="price_display" placeholder="{{ __('admin.enter_price') }}"
                        value="{{ old('price', isset($package) ? number_format($package->price, 0, ',', '.') : '') }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />

                    <!-- INPUT ASLI -->
                    <input type="hidden" name="price" id="price" value="{{ old('price', $package->price) }}">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.price') }}
                    </label>
                </div>

                <!-- Duration -->
                <div class="relative mt-2">
                    <input type="number" name="duration" placeholder="{{ __('admin.enter_duration') }}"
                        value="{{ old('duration', $package->duration) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.duration_label') }}
                    </label>
                </div>

                <!-- Guest Minimal -->
                <div class="relative mt-2">
                    <input type="number" name="guest_min" placeholder="{{ __('admin.enter_guest_min') }}"
                        value="{{ old('guest_min', $package->guest_min) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.guest_min') }}
                    </label>
                </div>

                <!-- Guest Maximal -->
                <div class="relative mt-2">
                    <input type="number" name="guest_max" placeholder="{{ __('admin.enter_guest_max') }}"
                        value="{{ old('guest_max', $package->guest_max) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.guest_max') }}
                    </label>
                </div>

                <!-- Tour Gallery -->
                <div class="mt-3 md:col-span-2">
                    <p class="text-sm text-darkGrey mb-3">
                        {{ __('admin.tour_gallery') }}
                    </p>
                    <label
                        class="flex items-center justify-center w-full
                   border border-dashed border-mediumGrey
                   rounded-xl h-40 cursor-pointer
                   text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">
                        <input type="file" name="galleries[]" id="galleryInput" multiple class="hidden">
                        <i class="fa-solid fa-image text-xl"></i>
                        {{ __('admin.upload_gallery') }}
                    </label>

                    <div id="galleryPreview" class="grid grid-cols-3 md:grid-cols-5 gap-4 mt-4">
                        @foreach ($package->galleries as $gallery)
                            <div class="relative existing-gallery">

                                <img src="{{ asset('storage/' . $gallery->image_url) }}"
                                    class="w-full h-24 object-cover rounded-lg shadow">

                                <button type="button" onclick="removeOldGallery({{ $gallery->id }}, this)"
                                    class="absolute -top-2 -right-2 bg-red text-white w-6 h-6 rounded-full text-xs">
                                    ✕
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- SUBMIT -->
            <div class="flex gap-4">

                <!-- SAVE -->
                <button type="submit"
                    class="bg-darkGreen text-white text-sm font-medium
               px-12 md:px-16 py-3 rounded-lg
               hover:bg-darkGreen/90 transition">
                    {{ __('admin.save') }}
                </button>

        </form>

        <!-- DELETE -->
        <form id="deletePackage" action="{{ route('package.tour.destroy', $package) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="button" onclick="confirmDelete('deletePackage', '{{ __('admin.delete_package') }}?')"
                class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                {{ __('admin.delete_package') }}
            </button>
        </form>

        </div>

    </section>
@endsection

@push('scripts')
    <script>
        // Main Image
const mainInput = document.getElementById('mainImage');
const mainPreview = document.getElementById('mainPreviewImg');
const mainIcon = document.getElementById('mainIcon');

// simpan URL lama (dari blade)
const oldImageUrl = mainPreview.src;

mainInput.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
        mainPreview.src = URL.createObjectURL(file);
        mainPreview.classList.remove('hidden');
        mainIcon.classList.add('hidden');
    }
});

// saat reload, kembalikan ke image lama
window.addEventListener('DOMContentLoaded', function() {
    if (!mainInput.files.length) {
        // jika tidak ada file baru yang dipilih, kembalikan ke image lama
        mainPreview.src = oldImageUrl;
        mainPreview.classList.remove('hidden');
        mainIcon.classList.toggle('hidden', oldImageUrl ? true : false);
    }
});

        // Type
        const locale = "{{ app()->getLocale() }}";
        const typeByCategoryUrl = "{{ route('types.by.category', ['category' => '__id__']) }}";

        function loadTypes(categoryId, oldType = null) {

            let typeDropdown = document.getElementById('type');

            typeDropdown.disabled = true;
            typeDropdown.innerHTML = '<option>Loading...</option>';

            fetch(typeByCategoryUrl.replace('__id__', categoryId))
                .then(res => res.json())
                .then(types => {

                    typeDropdown.innerHTML = '<option disabled hidden>Select type</option>';

                    types.forEach(type => {

                        let typeName = locale === 'id' ?
                            type.name_id :
                            type.name_en;

                        let selected = oldType && type.id == oldType ?
                            'selected' :
                            '';

                        typeDropdown.innerHTML += `
                    <option value="${type.id}" ${selected}>
                        ${typeName}
                    </option>
                `;
                    });

                    typeDropdown.disabled = false;
                });
        }
        document.getElementById('category')
            .addEventListener('change', function() {
                loadTypes(this.value);
            });


        // restore setelah validation error
        window.addEventListener('DOMContentLoaded', function() {

            let oldCategory = "{{ old('category_id', $package->category_id) }}";
            let oldType = "{{ old('type_id', $package->type_id) }}";

            if (oldCategory) {
                loadTypes(oldCategory, oldType);
            }

        });

        // Price
        const display = document.getElementById('price_display');
        const hidden = document.getElementById('price');

        display.addEventListener('input', function(e) {

            // ambil angka saja
            let number = this.value.replace(/\D/g, '');

            // set ke hidden input (untuk DB)
            hidden.value = number;

            // format rupiah
            if (number) {
                this.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
            } else {
                this.value = '';
            }
        });
        // format saat reload (validation error)
        window.addEventListener('DOMContentLoaded', function() {

            if (hidden.value) {
                display.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(hidden.value);
            }

        });

        // gallery
const galleryInput = document.getElementById('galleryInput');
const galleryPreview = document.getElementById('galleryPreview');

const maxTotal = 10;
let allFiles = [];

function getExistingCount() {
    return document.querySelectorAll('.existing-gallery').length;
}

galleryInput.addEventListener('change', function () {

    const newFiles = Array.from(this.files);

    newFiles.forEach(file => {

        const total = getExistingCount() + allFiles.length;

        // 🔥 kalau sudah limit → replace LAST image
        if (total >= maxTotal) {

            alert(`Maximum ${maxTotal} images. Last image replaced.`);

            if (allFiles.length > 0) {

                // hapus new terakhir
                allFiles.pop();

                // hapus preview terakhir
                const lastNew =
                    document.querySelector('.new-gallery:last-child');

                if (lastNew) lastNew.remove();

            } else {

                // kalau belum ada new file,
                // replace existing terakhir
                const lastExisting =
                    document.querySelector('.existing-gallery:last-child');

                if (lastExisting) {

                    const id = lastExisting
                        .querySelector('button')
                        ?.getAttribute('onclick')
                        ?.match(/\d+/)[0];

                    if (id) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'removed_galleries[]';
                        input.value = id;

                        document
                            .getElementById('updateForm')
                            .appendChild(input);
                    }

                    lastExisting.remove();
                }
            }
        }

        allFiles.push(file);
    });

    updateInputFiles();
    renderPreview();
});


// sync ke input file
function updateInputFiles() {

    const dt = new DataTransfer();

    allFiles.forEach(file => dt.items.add(file));

    galleryInput.files = dt.files;
}


// render preview
function renderPreview() {

    document
        .querySelectorAll('.new-gallery')
        .forEach(el => el.remove());

    allFiles.forEach((file, index) => {

        const wrapper = document.createElement('div');
        wrapper.className = 'relative new-gallery';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'w-full h-24 object-cover rounded-lg shadow';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.innerHTML = '✕';
        removeBtn.className =
            'absolute -top-2 -right-2 bg-mediumGrey text-white w-6 h-6 rounded-full text-xs';

        removeBtn.onclick = () => {

            allFiles.splice(index, 1);

            updateInputFiles();
            renderPreview();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(removeBtn);

        galleryPreview.appendChild(wrapper);
    });
}


// remove existing manual
function removeOldGallery(id, btn) {

    btn.parentElement.remove();

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'removed_galleries[]';
    input.value = id;

    document.getElementById('updateForm').appendChild(input);
}

    </script>
@endpush
