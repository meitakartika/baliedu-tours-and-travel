@extends('layout.admin')

@section('title', __('admin.edit_testimonial'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('testimonials.admin.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.edit_testimonial') }}
        </h1>

        <!-- FORM -->
        <form method="POST" action="{{ route('testimonials.admin.update', $testimonial) }}" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- TOP SECTION -->
            <div class="flex gap-8 items-start">

                <!-- AVATAR -->
                <div class="flex flex-col items-center gap-3 w-32">
                    @if ($testimonial->user->profile_image)
                        <img src="{{ asset('storage/' . $testimonial->user->profile_image) }}"
                            class="w-24 h-24 rounded-full object-cover">
                    @else
                        <div class="w-24 h-24 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-circle-user text-8xl text-darkGreen"></i>
                        </div>
                    @endif

                    <span class="text-xs text-mediumGrey">
                        {{ $testimonial->created_at->format('d M Y') }}
                    </span>
                </div>

                <!-- INPUTS -->
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NAME -->
                    <div class="relative mt-4">
                        <input type="text" name="name" readonly
                            value="{{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}"
                            class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.name') }}
                        </label>
                    </div>

                    <!-- EMAIL -->
                    <div class="relative mt-4">
                        <input type="email" name="email" readonly value="{{ $testimonial->user->email }}"
                            class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.email') }}
                        </label>
                    </div>

                    <!-- TOUR PACKAGE -->
                    <div class="relative mt-2">
                        <input type="text" name="tour" readonly
                            value="{{ app()->getLocale() == 'id' ? $testimonial->package->name_id : $testimonial->package->name_en }}"
                            class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.tour_package') }}
                        </label>
                    </div>

                    <!-- RATING -->
                    <div class="relative mt-2">
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.rating') }}
                        </label>

                        <div
                            class="bg-softGrey w-full rounded-md h-12
               flex items-center px-4 pt-4 gap-2
               text-2xl text-yellow-400">
                            @for ($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = $testimonial->rating; $i < 5; $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>

            <!-- TESTIMONIAL -->
            <div class="relative mt-2">
                <textarea name="message" rows="7" readonly
                    class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen">{{ $testimonial->comment }}</textarea>
                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                    {{ __('admin.testimonial') }}
                </label>
            </div>

            <!-- CURRENT IMAGE -->
            <div>
                <p class="text-sm font-medium text-darkGrey mb-3">
                    {{ __('admin.image_review') }}
                </p>

                <div class="w-full">
                    @if (!empty($testimonial->images) && count($testimonial->images) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($testimonial->images as $index => $img)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $img) }}" class="rounded-xl object-cover w-full h-32">
                                    <button type="button"
                                        class="absolute top-1 right-1 bg-red/80 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition"
                                        onclick="removeImage('{{ $img }}', this)">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-mediumGrey">{{ __('admin.no_images') }}</p>
                    @endif

                    <input type="hidden" name="images" id="imagesInput" value='@json($testimonial->images ?? [])'>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-4 mt-8">

                <!-- SAVE -->
                <button type="submit"
                    class="bg-darkGreen text-white text-sm font-medium
                           px-12 md:px-16 py-3 rounded-lg
                           hover:bg-darkGreen/90 transition">
                    {{ __('admin.save') }}
                </button>

        </form>

        <!-- DELETE -->
        <form id="deleteTestimonial" action="{{ route('testimonials.admin.destroy', $testimonial) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="button" onclick="confirmDelete('deleteTestimonial', '{{ __('admin.delete_testimonial') }}?')"
                class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                {{ __('admin.delete_testimonial') }}
            </button>
        </form>

        </div>

    </section>
@endsection

@push('scripts')
    <script>
        function removeImage(imgName, btn) {
            // Hapus dari DOM
            btn.closest('div').remove();

            // Update input hidden
            let imagesInput = document.getElementById('imagesInput');
            let images = JSON.parse(imagesInput.value);
            images = images.filter(i => i !== imgName);
            imagesInput.value = JSON.stringify(images);
        }
    </script>
@endpush
