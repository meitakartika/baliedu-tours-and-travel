@extends('layout.admin')

@section('title', 'Reviews Section')

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
            Reviews Section
        </h1>

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
            <div class="rounded-lg bg-green-50 border border-green-500 p-4 text-green-700 text-sm mb-6">
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
        <form action="{{ route('page.reviews.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- HEADING CONTENT -->
            <div>
                <h2 class="text-darkGrey font-semibold mb-5">
                    Heading Content
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- LABEL ID -->
                    <div class="relative mt-4">
                        <input type="text" name="label_id" value="{{ old('label_id', $reviewsSection->label_id) }}"
                            placeholder="Enter label"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Label (ID)
                        </label>
                    </div>

                    <!-- LABEL EN -->
                    <div class="relative mt-4">
                        <input type="text" name="label_en" value="{{ old('label_en', $reviewsSection->label_en) }}"
                            placeholder="Enter label"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Label (EN)
                        </label>
                    </div>

                    <!-- TITLE 1 ID -->
                    <div class="relative mt-2">
                        <input type="text" name="title_1_id" value="{{ old('title_1_id', $reviewsSection->title_1_id) }}"
                            placeholder="Enter title"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Title 1 (ID)
                        </label>
                    </div>

                    <!-- TITLE 1 EN -->
                    <div class="relative mt-2">
                        <input type="text" name="title_1_en" value="{{ old('title_1_en', $reviewsSection->title_1_en) }}"
                            placeholder="Enter title"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Title 1 (EN)
                        </label>
                    </div>

                </div>
            </div>

            <!-- RATING CONTENT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <hr class="border-darkGreen mt-3 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                    Rating Content
                </h2>

                <!-- RATING NUMBER -->
                <div class="relative mt-2 col-span-2">
                    <input type="number" name="rating_number" step="0.1" min="0" max="5"
                        value="{{ old('rating_number', $reviewsSection->rating_number) }}" placeholder="Enter rating"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Rating Number (Maximum 5)
                    </label>
                </div>

                <!-- REVIEWS TEXT ID -->
                <div class="relative mt-2">
                    <input type="text" name="reviews_text_id"
                        value="{{ old('reviews_text_id', $reviewsSection->reviews_text_id) }}" placeholder="Enter text"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Reviews Text (ID)
                    </label>
                </div>

                <!-- REVIEWS TEXT EN -->
                <div class="relative mt-2">
                    <input type="text" name="reviews_text_en"
                        value="{{ old('reviews_text_en', $reviewsSection->reviews_text_en) }}" placeholder="Enter text"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Reviews Text (EN)
                    </label>
                </div>

            </div>

            <!-- HAPPY TRAVELERS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <hr class="border-darkGreen mt-3 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                    Happy Travelers Content
                </h2>

                <!-- TRAVELERS NUMBER -->
                <div class="relative mt-2 col-span-2">
                    <input type="number" name="travelers_number" min="0"
                        value="{{ old('travelers_number', $reviewsSection->travelers_number) }}" placeholder="Enter number"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Travelers Number
                    </label>
                </div>

                <!-- TRAVELERS TEXT ID -->
                <div class="relative mt-2">
                    <input type="text" name="travelers_text_id"
                        value="{{ old('travelers_text_id', $reviewsSection->travelers_text_id) }}"
                        placeholder="Enter text (ID)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Travelers Text (ID)
                    </label>
                </div>

                <!-- TRAVELERS TEXT EN -->
                <div class="relative mt-2">
                    <input type="text" name="travelers_text_en"
                        value="{{ old('travelers_text_en', $reviewsSection->travelers_text_en) }}"
                        placeholder="Enter text (EN)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Travelers Text (EN)
                    </label>
                </div>

            </div>

            <!-- TESTIMONIAL CARDS -->
            @for ($i = 1; $i <= 3; $i++)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <hr class="border-darkGreen mt-3 col-span-2">

                    <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                        Testimonial Card {{ $i }}
                    </h2>

                    <!-- CARD TITLE ID -->
                    <div class="relative mt-2">
                        <input type="text" name="card_title_{{ $i }}_id"
                            value="{{ old('card_title_' . $i . '_id', $reviewsSection->{'card_title_' . $i . '_id'}) }}"
                            placeholder="Enter review title"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Review Title (ID)
                        </label>
                    </div>

                    <!-- CARD TITLE EN -->
                    <div class="relative mt-2">
                        <input type="text" name="card_title_{{ $i }}_en"
                            value="{{ old('card_title_' . $i . '_en', $reviewsSection->{'card_title_' . $i . '_en'}) }}"
                            placeholder="Enter review title"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Review Title (EN)
                        </label>
                    </div>

                    <!-- DESCRIPTION ID -->
                    <div class="relative mt-2">
                        <textarea name="card_description_{{ $i }}_id" rows="5" placeholder="Enter review description (ID)"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen">{{ old('card_description_' . $i . '_id', $reviewsSection->{'card_description_' . $i . '_id'}) }}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Description (ID)
                        </label>
                    </div>

                    <!-- DESCRIPTION EN -->
                    <div class="relative mt-2">
                        <textarea name="card_description_{{ $i }}_en" rows="5" placeholder="Enter review description (EN)"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen">{{ old('card_description_' . $i . '_en', $reviewsSection->{'card_description_' . $i . '_en'}) }}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Description (EN)
                        </label>
                    </div>


                    <!-- REVIEWER INFORMATION & IMAGE -->
                    <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">


                        <!-- REVIEWER IMAGE -->
                        <div>
                            <label class="block text-sm text-darkGrey font-medium mb-4">
                                Reviewer Image {{ $i }}
                            </label>

                            <div class="flex justify-center">
                                <div class="relative">

                                    <label class="relative cursor-pointer block">
                                        <input type="file" id="reviewer_image_{{ $i }}"
                                            name="reviewer_image_{{ $i }}"
                                            accept="image/jpeg,image/png,image/webp" class="hidden"
                                            onchange="previewReviewerImage(event, {{ $i }})">

                                        <div
                                            class="w-36 h-36 rounded-full bg-mediumGrey/10
                    flex items-center justify-center overflow-hidden">

                                            <img id="preview_{{ $i }}"
                                                @if ($reviewsSection->{'reviewer_image_' . $i}) src="{{ asset('storage/' . $reviewsSection->{'reviewer_image_' . $i}) }}" @endif
                                                class="{{ $reviewsSection->{'reviewer_image_' . $i} ? '' : 'hidden' }}
                            w-full h-full object-cover">

                                            <i id="icon_{{ $i }}"
                                                class="fa-regular fa-image text-3xl text-darkGrey
                        {{ $reviewsSection->{'reviewer_image_' . $i} ? 'hidden' : '' }}">
                                            </i>
                                        </div>
                                    </label>

                                    <!-- REMOVE BUTTON -->
                                    @if ($reviewsSection->{'reviewer_image_' . $i})
                                        <button type="button" onclick="removeReviewerImage({{ $i }}, this)"
                                            class="absolute -top-2 -right-2 bg-red text-white w-6 h-6 rounded-full text-xs">
                                            ✕
                                        </button>
                                    @endif

                                </div>
                            </div>

                            <p class="text-xs text-mediumGrey text-center mt-3">
                                Click image to upload
                            </p>

                        </div>

                        <!-- REVIEWER DETAILS -->
                        <div class="space-y-6">

                            <!-- REVIEWER NAME -->
                            <div class="relative mt-4">
                                <input type="text" name="reviewer_name_{{ $i }}"
                                    value="{{ old('reviewer_name_' . $i, $reviewsSection->{'reviewer_name_' . $i}) }}"
                                    placeholder="Enter reviewer name"
                                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Reviewer Name
                                </label>
                            </div>

                            <!-- COUNTRY ID -->
                            <div class="relative">
                                <input type="text" name="reviewer_country_{{ $i }}_id"
                                    value="{{ old('reviewer_country_' . $i . '_id', $reviewsSection->{'reviewer_country_' . $i . '_id'}) }}"
                                    placeholder="Enter country (ID)"
                                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Country (ID)
                                </label>
                            </div>

                            <!-- COUNTRY EN -->
                            <div class="relative">
                                <input type="text" name="reviewer_country_{{ $i }}_en"
                                    value="{{ old('reviewer_country_' . $i . '_en', $reviewsSection->{'reviewer_country_' . $i . '_en'}) }}"
                                    placeholder="Enter country (EN)"
                                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen">

                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Country (EN)
                                </label>
                            </div>

                        </div>
                    </div>

                </div>
            @endfor

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
        function previewReviewerImage(event, index) {
            const file = event.target.files[0];

            if (!file) return;

            const preview = document.getElementById(`preview_${index}`);
            const icon = document.getElementById(`icon_${index}`);

            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        }


        function removeReviewerImage(index, button) {
            const preview = document.getElementById(`preview_${index}`);
            const icon = document.getElementById(`icon_${index}`);
            const fileInput = document.getElementById(`reviewer_image_${index}`);

            // Tandai gambar lama untuk dihapus
            let removeInput = document.querySelector(
                `input[name="remove_image_${index}"]`
            );

            if (!removeInput) {
                removeInput = document.createElement('input');
                removeInput.type = 'hidden';
                removeInput.name = `remove_image_${index}`;
                removeInput.value = '1';

                document.querySelector('form[action="{{ route('page.reviews.update') }}"]')
                    .appendChild(removeInput);
            }

            // Reset preview
            preview.src = '';
            preview.classList.add('hidden');
            icon.classList.remove('hidden');

            // Reset file input
            fileInput.value = '';

            // Hilangkan tombol X
            button.remove();
        }
    </script>
@endpush
