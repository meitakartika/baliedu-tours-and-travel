@extends('layout.admin')

@section('title', __('admin.add_new_itinerary'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.itinerary.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.add_new_itinerary') }}
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
        <form action="{{ route('package.itinerary.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <h2 class="font-semibold text-base text-darkGrey mt-4">{{ __('admin.tour_package') }}</h2>
                <div class="col-span-2">
                    <div class="relative mt-1">
                        <select name="package_id"
                            class="peer appearance-none bg-white w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey"
                            required>

                            <option value="" disabled selected hidden>
                                {{ __('admin.select_tour_package') }}
                            </option>

                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}"
                                    {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'id' ? $package->name_id : $package->name_en }}
                                </option>
                            @endforeach

                        </select>

                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>

                        <label
                            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white
               peer-focus:text-darkGreen">
                            {{ __('admin.tour_package') }}
                        </label>
                    </div>
                </div>

                <hr class="border-2 border-darkGreen mt-4 col-span-2">

                <!-- TEMPLATE ITINERARY -->
                <template id="itinerary-template">
                    <div class="itinerary-item grid grid-cols-1 md:grid-cols-2 gap-6 col-span-2">
                        <div class="flex items-center justify-between col-span-2 mt-4">

                            <h2 class="itinerary-title font-semibold text-base text-darkGrey">
                                {{ __('admin.itinerary_details') }} __INDEX_DISPLAY__
                            </h2>

                            <button type="button"
                                class="delete-itinerary flex items-center gap-2 text-red text-sm font-medium hover:opacity-70">
                                <i class="fa-solid fa-trash"></i>
                                {{ __('admin.delete') }}
                            </button>

                        </div>

                        <!-- Name ID -->
                        <div class="relative mt-1">
                            <input type="text" name="itineraries[__INDEX__][title_id]"
                                placeholder="{{ __('admin.enter_indonesian_name') }}"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.name') }} (ID)
                            </label>
                        </div>

                        <!-- Name EN -->
                        <div class="relative mt-1">
                            <input type="text" name="itineraries[__INDEX__][title_en]"
                                placeholder="{{ __('admin.enter_english_name') }}"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.name') }} (EN)
                            </label>
                        </div>

                        <!-- DAY -->
                        <div class="relative mt-2">
                            <input type="number" name="itineraries[__INDEX__][day]" placeholder="{{ __('admin.enter_day') }}"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.day') }}
                            </label>
                        </div>

                        <!-- Time -->
                        <div class="relative mt-2">
                            <input type="time" name="itineraries[__INDEX__][time]" placeholder="{{ __('admin.select_time') }}"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.time') }}
                            </label>
                        </div>

                        <div class="detail-wrapper col-span-2">
                            <div class="detail-item grid grid-cols-2 gap-4 relative">
                                <!-- DELETE BUTTON -->
                                <button type="button"
                                    class="remove-description absolute -top-2 -right-3 z-20 bg-red text-white w-6 h-6 rounded-full text-xs flex items-center justify-center hover:bg-red/80">
                                    <i class="fa-solid fa-xmark text-[10px]"></i>
                                </button>
                                <!-- Description ID -->
                                <div class="relative mt-2">
                                    <textarea name="itineraries[__INDEX__][details][0][description_id]" rows="4"
                                        placeholder="{{ __('admin.enter_indonesian_description') }}"
                                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                        {{ __('admin.description') }} (ID)
                                    </label>
                                </div>

                                <!-- Description EN -->
                                <div class="relative mt-2">
                                    <textarea name="itineraries[__INDEX__][details][0][description_en]" rows="4"
                                        placeholder="{{ __('admin.enter_english_description') }}"
                                        class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                        {{ __('admin.description') }} (EN)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- ADD MORE DESCRIPTION -->
                        <button type="button"
                            class="add-description flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                            <i class="fa-solid fa-plus"></i>
                            {{ __('admin.add_more_description') }}
                        </button>

                        <hr class="border-darkGreen mt-4 col-span-2">

                    </div>
                </template>

                <div id="itinerary-wrapper" class="space-y-2 col-span-2"></div>

                <!-- ADD MORE DETAILS -->
                <div class="mt-4 col-span-2">
                    <label
                        class="add-itinerary flex items-center justify-center w-full
                   border border-dashed border-mediumGrey
                   rounded-xl h-40 cursor-pointer
                   text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">
                        <i class="fa-solid fa-plus text-xl"></i>
                        {{ __('admin.add_more_itinerary') }}
                    </label>
                </div>

                <!-- SUBMIT -->
                <button
                    class="bg-darkGreen text-white text-sm font-medium
                   px-12 py-3 rounded-lg w-1/2 lg:w-1/3 col-span-2
                   hover:bg-darkGreen/90 transition">
                    {{ __('admin.add_new') }}
                </button>
            </div>
        </form>

    </section>
@endsection

@push('scripts')
    <script>
        let itineraryIndex = 0;

        function toggleDeleteButtons() {

            const allItineraries =
                document.querySelectorAll('.itinerary-item');

            const deleteButtons =
                document.querySelectorAll('.delete-itinerary');

            if (allItineraries.length <= 1) {

                deleteButtons.forEach(btn => {
                    btn.classList.add('hidden');
                });

            } else {

                deleteButtons.forEach(btn => {
                    btn.classList.remove('hidden');
                });

            }
        }

        // AUTO LOAD FIRST ITINERARY
        document.addEventListener("DOMContentLoaded", () => {

            const oldItineraries = @json(old('itineraries'));

            if (oldItineraries && oldItineraries.length > 0) {

                oldItineraries.forEach((itinerary, i) => {
                    addItinerary(itinerary);
                });

            } else {
                addItinerary();
            }
        });

        // ================= ADD ITINERARY =================
        function addItinerary(oldData = null) {

            const template = document
                .getElementById("itinerary-template")
                .innerHTML;

            const html = template
                .replaceAll('__INDEX__', itineraryIndex)
                .replaceAll('__INDEX_DISPLAY__', itineraryIndex + 1);

            document
                .getElementById('itinerary-wrapper')
                .insertAdjacentHTML('beforeend', html);

            // ================= FILL OLD =================
            if (oldData) {

                const currentItem = document
                    .querySelectorAll('.itinerary-item')[itineraryIndex];

                currentItem.querySelector(`[name="itineraries[${itineraryIndex}][title_id]"]`).value =
                    oldData.title_id ?? '';

                currentItem.querySelector(`[name="itineraries[${itineraryIndex}][title_en]"]`).value =
                    oldData.title_en ?? '';

                currentItem.querySelector(`[name="itineraries[${itineraryIndex}][day]"]`).value =
                    oldData.day ?? '';

                currentItem.querySelector(`[name="itineraries[${itineraryIndex}][time]"]`).value =
                    oldData.time ?? '';

                // DETAILS
                const detailWrapper = currentItem.querySelector('.detail-wrapper');

                detailWrapper.innerHTML = '';

                if (oldData.details) {

                    oldData.details.forEach((detail, dIndex) => {

                        const detailHTML = `
                <div class="detail-item grid grid-cols-2 gap-4">

                    <div class="relative mt-4">
                        <textarea
                        name="itineraries[${itineraryIndex}][details][${dIndex}][description_id]"
                        placeholder="{{ __('admin.enter_indonesian description') }}n" rows="4"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-none focus:outline-none focus:border-darkGreen">${detail.description_id ?? ''}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description') }} (ID)
                        </label>
                    </div>

                    <div class="relative mt-4">
                        <textarea
                        name="itineraries[${itineraryIndex}][details][${dIndex}][description_en]"
                        placeholder="{{ __('admin.enter_english_description') }}" rows="4"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-none focus:outline-none focus:border-darkGreen">${detail.description_en ?? ''}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description') }} (EN)
                        </label>
                    </div>

                </div>
                `;

                        detailWrapper.insertAdjacentHTML('beforeend', detailHTML);
                    });
                }
            }

            toggleDeleteButtons();
            itineraryIndex++;
        }

        // CLICK ADD ITINERARY
        document.addEventListener('click', function(e) {

            if (e.target.closest('.add-itinerary')) {
                addItinerary();
            }

        });


        // ================= ADD DESCRIPTION =================
        document.addEventListener('click', function(e) {

            if (!e.target.closest('.add-description')) return;

            const itineraryItem = e.target.closest('.itinerary-item');

            const detailWrapper = itineraryItem.querySelector('.detail-wrapper');

            const itineraryInputs =
                itineraryItem.querySelectorAll("textarea");

            // hitung detail index
            const detailIndex =
                detailWrapper.querySelectorAll('.detail-item').length;

            // ambil itinerary index dari name
            const firstTextarea = itineraryItem.querySelector('textarea');

            const match = firstTextarea.name.match(/itineraries\[(\d+)\]/);

            const itineraryIdx = match[1];

            // bikin detail baru
            const detailHTML = `
        <div class="detail-item grid grid-cols-2 gap-4 relative">
 <button type="button"
        class="remove-description absolute -right-3 z-20 bg-red text-white w-6 h-6 rounded-full text-xs flex items-center justify-center hover:bg-red/80">
        <i class="fa-solid fa-xmark text-[10px]"></i>
    </button>
            <div class="relative mt-4">
            <textarea
                name="itineraries[${itineraryIdx}][details][${detailIndex}][description_id]"
                placeholder="{{ __('admin.enter_indonesian_description') }}" rows="4"
                class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                {{ __('admin.description') }} (ID)
                </label>
                </div>

            <div class="relative mt-4">
            <textarea
                name="itineraries[${itineraryIdx}][details][${detailIndex}][description_en]"
                placeholder="{{ __('admin.enter_english_description') }}" rows="4"
                class="bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 py-3 text-sm resize-none
               focus:outline-none focus:border-darkGreen"></textarea>
               <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                {{ __('admin.description') }} (EN)
                </label>
                </div>

        </div>
    `;

            detailWrapper.insertAdjacentHTML('beforeend', detailHTML);

        });

        // ================= REMOVE DESCRIPTION =================
        document.addEventListener('click', function(e) {

            if (!e.target.closest('.remove-description')) return;

            const detailItem = e.target.closest('.detail-item');
            const detailWrapper = detailItem.closest('.detail-wrapper');

            detailItem.remove();

            // OPTIONAL: re-index ulang supaya name tetap urut
            const itineraryItem = detailWrapper.closest('.itinerary-item');
            const firstTextarea = itineraryItem.querySelector('textarea');
            const match = firstTextarea.name.match(/itineraries\[(\d+)\]/);
            const itineraryIdx = match[1];

            const allDetails = detailWrapper.querySelectorAll('.detail-item');

            allDetails.forEach((item, index) => {

                const textareas = item.querySelectorAll('textarea');

                textareas[0].name =
                    `itineraries[${itineraryIdx}][details][${index}][description_id]`;

                textareas[1].name =
                    `itineraries[${itineraryIdx}][details][${index}][description_en]`;
            });

        });

        // ================= DELETE ITINERARY =================

        document.addEventListener('click', function(e) {

            if (!e.target.closest('.delete-itinerary')) return;

            const allItineraries =
                document.querySelectorAll('.itinerary-item');

            const itineraryItem =
                e.target.closest('.itinerary-item');

            itineraryItem.remove();

            // ================= RE-INDEX =================
            const remainingItineraries =
                document.querySelectorAll('.itinerary-item');

            remainingItineraries.forEach((item, index) => {

                // Update title display
                const title = item.querySelector('.itinerary-title');
                title.textContent = `Itinerary Details ${index + 1}`;

                // Update semua input & textarea name
                const inputs =
                    item.querySelectorAll('input, textarea');

                inputs.forEach(input => {

                    const name = input.name;

                    if (!name) return;

                    const newName =
                        name.replace(/itineraries\[\d+\]/,
                            `itineraries[${index}]`);

                    input.name = newName;
                });

            });

            // Update global index supaya next add tidak bentrok
            itineraryIndex = remainingItineraries.length;

            toggleDeleteButtons();
        });
    </script>
@endpush
