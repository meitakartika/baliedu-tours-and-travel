@extends('layout.app')

@section('title', 'Testimonials')

@section('content')

    <!-- ================= HERO TESTIMONIALS ================= -->
    <section class="relative h-[380px] md:h-[420px]">

        <!-- Background Image -->
        <img src="/images/testimonials-hero.png" alt="Testimonials Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- CONTENT WRAPPER -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 h-full">

            <!-- Back -->
            <a href="{{ route('testimonials') }}"
                class="absolute bottom-6 md:bottom-8 left-6 inline-flex items-center gap-3
                  text-white text-sm md:text-base font-medium hover:text-lightGreen transition">
                <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
                Back to Testimonials
            </a>

            <!-- Title -->
            <div class="h-full flex items-center justify-center">
                <h1 class="text-white text-3xl md:text-4xl font-semibold">
                    My <span class="text-lightGreen">Testimonial</span>
                </h1>
            </div>

        </div>
    </section>

    <!-- ================= FORM ================= -->
    <section class="max-w-7xl mx-auto px-6 py-24">

        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                Share Your Story
            </h2>
            <p class="text-darkGrey leading-relaxed">
                Share your best moments from the tour with us.
            </p>
        </div>

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
            <div class="rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm mb-10">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('testimonials.store', $booking->id) }}" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            @csrf

            <!-- LEFT : IMAGE -->
            <div class="flex flex-col items-center gap-8">
                <!-- Preview Container -->
<div id="previewContainer" class="grid grid-cols-2 gap-3 max-w-sm">
    <!-- placeholder awal akan ditampilkan lewat JS -->
</div>

<label class="inline-flex items-center gap-2 px-5 py-2.5 border border-darkGreen text-darkGreen rounded-lg text-sm font-medium cursor-pointer hover:bg-darkGreen hover:text-white transition">
    Upload Image
    <i class="fa-solid fa-upload"></i>
    <input type="file" id="imagesInput" name="images[]" multiple class="hidden">
</label>
            </div>

            <!-- RIGHT : FORM -->
            <div class="lg:col-span-2 space-y-8">

                <div class="relative">
                    <input type="text" name="name"value="{{ $user->first_name }} {{ $user->last_name }}" readonly
                        class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Name
                    </label>
                </div>

                <div class="relative">
                    <input type="email" name="email" value="{{ $user->email }}" readonly
                        class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Email
                    </label>
                </div>

                <div class="relative">
                    <select name="country"
                        class="peer appearance-none bg-white w-full border border-lightGrey 
               rounded-md px-3 pr-10 text-sm h-12
               focus:outline-none focus:border-darkGreen text-darkGrey">

                        <option value="" disabled {{ old('country', $user->country ?? '') ? '' : 'selected' }}>Select
                            country</option>

                        @foreach ($countries as $code => $name)
                            <option value="{{ $code }}"
                                {{ old('country', $user->country ?? '') == $code ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach

                    </select>

                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </span>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Country
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

                    <div class="relative">
                        <input type="text"
                            value="{{ app()->getLocale() == 'id' ? $booking->package->name_id : $booking->package->name_en }}"
                            readonly
                            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                   focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                            Tour Package
                        </label>
                    </div>

                    <div class="relative">
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                            Rating
                        </label>

                        <div
                            class="bg-white w-full rounded-md h-12
            flex items-center px-4 pt-4 gap-2
            text-2xl text-mediumGrey/20">

                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-regular fa-star cursor-pointer transition"></i>
                            @endfor
                        </div>

                        <input type="hidden" name="rating" id="rating">

                    </div>

                </div>

                <div class="relative">
                    <textarea name="comment" rows="7"
                        placeholder="Share your experience with us... What did you enjoy most? Would you recommend us to others?"
                        class="bg-white w-full border border-lightGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen">{{ old('comment') }}</textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Testimonial
                    </label>
                </div>

                <div class="flex items-start gap-3 text-sm text-darkGrey relative -top-2">
                    <input type="checkbox" name="agreement" class="mt-1">
                    <p>
                        I confirm that this review is based on my personal experience
                        and reflects my own opinion.
                    </p>
                </div>

                <button
                    class="w-full bg-darkGreen text-white py-3 rounded-lg
                           font-medium hover:bg-darkGreen/90 transition">
                    Submit
                </button>
            </div>
        </form>
    </section>

@endsection

@push('scripts')
    <script>
        
let filesArray = [];

const input = document.getElementById('imagesInput');
const container = document.getElementById('previewContainer');

function renderPlaceholder() {
    if (filesArray.length === 0) {
        container.className = "flex items-center justify-center";
        container.innerHTML = `
            <div class="flex items-center justify-center w-80 h-64 rounded-2xl bg-lightGrey border overflow-hidden">
                <i class="fa-regular fa-image text-4xl text-mediumGrey"></i>
            </div>`;
    }
}

function handleFiles(e) {
    const selectedFiles = Array.from(e.target.files);

    // Tambahkan ke array tapi **jangan reset input**!
    filesArray.push(...selectedFiles);

    container.innerHTML = ''; // hapus placeholder
    container.className = "grid grid-cols-2 gap-3 max-w-sm";

    filesArray.forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = ev => {
            const div = document.createElement('div');
            div.className = 'relative w-full aspect-square bg-lightGrey rounded-2xl border flex items-center justify-center overflow-hidden';
            div.innerHTML = `
                <img src="${ev.target.result}" class="w-full h-full object-cover">
                <button type="button" class="absolute top-1 right-1 bg-white rounded-full w-6 h-6 flex items-center justify-center text-red font-bold hover:bg-red/10">×</button>
            `;
            // tombol hapus
            div.querySelector('button').addEventListener('click', () => {
                filesArray.splice(idx, 1);
                div.remove();
                renderPlaceholder();

                // **reset input files** dan rebuild FileList
                const dataTransfer = new DataTransfer();
                filesArray.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files;
            });

            container.appendChild(div);
        }
        reader.readAsDataURL(file);
    });

    // update input files ke semua filesArray
    const dataTransfer = new DataTransfer();
    filesArray.forEach(f => dataTransfer.items.add(f));
    input.files = dataTransfer.files;
}

// event listener
input.addEventListener('change', handleFiles);

// render placeholder pertama kali
document.addEventListener('DOMContentLoaded', renderPlaceholder);

        const stars = document.querySelectorAll('.fa-star');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {

                ratingInput.value = index + 1;

                stars.forEach((s, i) => {
                    s.classList.toggle('fa-solid', i <= index);
                    s.classList.toggle('fa-regular', i > index);
                    s.classList.toggle('text-yellow-400', i <= index);
                });
            });
        });
    </script>
@endpush
