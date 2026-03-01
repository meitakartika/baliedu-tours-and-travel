@extends('layout.admin')

@section('title', 'Edit Itinerary')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.itinerary.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Edit Itinerary
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

        <form method="POST" action="{{ route('package.itinerary.update', $package->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- PACKAGE -->
                <h2 class="font-semibold text-base text-darkGrey mt-4">Tour Package</h2>
                <div class="col-span-2">
                    <div class="relative mt-1">
                        <select name="package_id"
                            class="peer appearance-none bg-white w-full border border-mediumGrey rounded-md
                        px-3 text-sm h-12 focus:outline-none focus:border-darkGreen text-darkGrey"
                            required>

                            <option value="" disabled hidden>Select the tour package</option>

                            @foreach ($packages as $pkg)
                                <option value="{{ $pkg->id }}"
                                    {{ old('package_id', $package->id) == $pkg->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'id' ? $pkg->name_id : $pkg->name_en }}
                                </option>
                            @endforeach

                        </select>

                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                            Tour Package
                        </label>
                    </div>
                </div>

                <hr class="border-2 border-darkGreen mt-4 col-span-2">

                <!-- TEMPLATE -->
                <template id="itinerary-template">

                    <div class="itinerary-item grid grid-cols-1 md:grid-cols-2 gap-6 col-span-2">

                        <input type="hidden" name="itineraries[__INDEX__][id]" value="__ID__">

                        <div class="flex items-center justify-between col-span-2 mt-4">

                            <h2 class="font-semibold text-base text-darkGrey">
                                Itinerary Details __INDEX_DISPLAY__
                            </h2>

                            <button type="button"
                                class="delete-itinerary flex items-center gap-2 text-red text-sm font-medium hover:opacity-70">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </button>

                        </div>

                        <!-- TITLE ID -->
                        <div class="relative mt-1">
                            <input type="text" name="itineraries[__INDEX__][title_id]"
                                placeholder="Enter the indonesian name"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Name (ID)
                            </label>
                        </div>

                        <!-- TITLE EN -->
                        <div class="relative mt-1">
                            <input type="text" name="itineraries[__INDEX__][title_en]"
                                placeholder="Enter the english name"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Name (EN)
                            </label>
                        </div>

                        <!-- DAY -->
                        <div class="relative mt-2">
                            <input type="number" name="itineraries[__INDEX__][day]" placeholder="Enter day number"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Day
                            </label>
                        </div>

                        <!-- TIME -->
                        <div class="relative mt-2">
                            <input type="time" name="itineraries[__INDEX__][time]" placeholder="Select the time"
                                class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                Time
                            </label>
                        </div>

                        <div class="detail-wrapper col-span-2"></div>

                        <!-- ADD DETAIL -->
                        <button type="button"
                            class="add-description flex items-center gap-2 text-sm font-medium text-darkGreen">
                            <i class="fa-solid fa-plus"></i>
                            Add More Description
                        </button>

                        <hr class="border-darkGreen mt-4 col-span-2">

                    </div>
                </template>

                <div id="itinerary-wrapper" class="space-y-2 col-span-2"></div>

                <!-- ADD -->
                <div class="mt-4 col-span-2">
                    <label
                        class="add-itinerary flex items-center justify-center w-full
                    border border-dashed border-mediumGrey
                    rounded-xl h-40 cursor-pointer
                    text-sm text-mediumGrey hover:border-darkGreen hover:text-darkGreen gap-2">
                        <i class="fa-solid fa-plus text-xl"></i>
                        Add More Itinerary Details
                    </label>
                </div>

            </div>

            <!-- SUBMIT -->
            <div class="flex gap-4 pt-4">

                <!-- SAVE -->
                <button type="submit"
                    class="bg-darkGreen text-white text-sm font-medium px-12 md:px-16 py-3 rounded-lg hover:bg-darkGreen/90 transition">
                    Save
                </button>
        </form>

        <!-- DELETE -->
        <form id="deleteItinerary" action="{{ route('package.itinerary.destroy', $package->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="button" onclick="confirmDelete('deleteItinerary','Delete All Itineraries in this Package?')"
                class="bg-red text-white text-sm font-medium
                   px-8 py-3 rounded-lg hover:bg-red/90 transition">
                Delete Itinerary
            </button>
        </form>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let itineraryIndex = 0;

        document.addEventListener("DOMContentLoaded", () => {

            const itineraries = @json(old('itineraries') ?? $package->itineraries);

            if (itineraries.length) {
                itineraries.forEach(it => addItinerary(it));
            } else {
                addItinerary();
            }
        });


        // ================= ADD ITINERARY =================

        function addItinerary(oldData = null) {

            let template = document
                .getElementById('itinerary-template')
                .innerHTML;

            template = template
                .replaceAll('__INDEX__', itineraryIndex)
                .replaceAll('__INDEX_DISPLAY__', itineraryIndex + 1)
                .replaceAll('__ID__', oldData?.id ?? '');

            document
                .getElementById('itinerary-wrapper')
                .insertAdjacentHTML('beforeend', template);

            const current = document.querySelectorAll('.itinerary-item')[itineraryIndex];

            if (oldData) {

                current.querySelector(`[name="itineraries[${itineraryIndex}][title_id]"]`).value = oldData.title_id ?? '';
                current.querySelector(`[name="itineraries[${itineraryIndex}][title_en]"]`).value = oldData.title_en ?? '';
                current.querySelector(`[name="itineraries[${itineraryIndex}][day]"]`).value = oldData.day ?? '';
                current.querySelector(`[name="itineraries[${itineraryIndex}][time]"]`).value = oldData.time ?? '';

                if (oldData.details) {
                    oldData.details.forEach((d, i) => {
                        addDetail(current, itineraryIndex, d, i);
                    });
                }
            } else {
                addDetail(current, itineraryIndex);
            }

            itineraryIndex++;
        }


        // ================= DETAIL =================

        function addDetail(wrapper, itineraryIdx, detail = null, dIndex = null) {

            const detailWrapper = wrapper.querySelector('.detail-wrapper');

            const index = dIndex ?? detailWrapper.querySelectorAll('.detail-item').length;

            const html = `
    <div class="detail-item grid grid-cols-2 gap-4 relative mt-2">

    <input type="hidden"
        name="itineraries[${itineraryIdx}][details][${index}][id]"
        value="${detail?.id ?? ''}">

        <!-- DELETE -->
        <button type="button"
        class="delete-detail absolute -top-2 -right-3 z-20
        bg-red text-white w-6 h-6 rounded-full 
        text-xs flex items-center justify-center 
        hover:bg-red/80">
        <i class="fa-solid fa-xmark text-[10px]"></i>
    </button>
    
    <div class="relative mt-2">
        <textarea
        name="itineraries[${itineraryIdx}][details][${index}][description_id]"
        rows="4" placeholder="Enter the indonesian description"
        class="bg-softGrey w-full border border-mediumGrey  rounded-md px-3 py-3 text-sm resize-none focus:outline-none focus:border-darkGreen">${detail?.description_id ?? ''}</textarea>

        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
            Description (ID)
        </label>
    </div>

    <div class="relative mt-2">
        <textarea
        name="itineraries[${itineraryIdx}][details][${index}][description_en]"
        rows="4" placeholder="Enter the english description"
        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-none focus:outline-none focus:border-darkGreen">${detail?.description_en ?? ''}</textarea>

        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
            Description (EN)
        </label>
    </div>

</div>`;

            detailWrapper.insertAdjacentHTML('beforeend', html);
        }


        // CLICK HANDLERS

        document.addEventListener('click', e => {

            if (e.target.closest('.add-itinerary')) {
                addItinerary();
            }

            if (e.target.closest('.add-description')) {

                const itineraryItem = e.target.closest('.itinerary-item');

                // Ambil input pertama yg pasti ada
                const input = itineraryItem.querySelector('input[name^="itineraries["]');

                const match = input.name.match(/itineraries\[(\d+)\]/);

                const itineraryIdx = match[1];

                addDetail(itineraryItem, itineraryIdx);
            }

            if (e.target.closest('.delete-itinerary')) {
                e.target.closest('.itinerary-item').remove();
            }

            if (e.target.closest('.delete-detail')) {
                e.target.closest('.detail-item').remove();
            }

        });
    </script>
@endpush
