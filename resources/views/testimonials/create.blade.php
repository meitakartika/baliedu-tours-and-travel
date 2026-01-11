@extends('layout.app')

@section('title', 'Testimonials')

@section('content')

    <!-- ================= HERO TESTIMONIALS ================= -->
<section class="relative h-[380px] md:h-[420px]">

    <!-- Background Image -->
    <img src="/images/testimonials-hero.png"
         alt="Testimonials Hero"
         class="absolute inset-0 w-full h-full object-cover">

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

        <form class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- LEFT : IMAGE -->
            <div class="flex flex-col items-center gap-8">
                <div
                    class="w-full aspect-square max-w-sm bg-lightGrey rounded-2xl
                           flex items-center justify-center border">
                    <i class="fa-regular fa-image text-4xl text-mediumGrey"></i>
                </div>

                <label
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           border border-darkGreen text-darkGreen rounded-lg
                           text-sm font-medium cursor-pointer hover:bg-darkGreen hover:text-white transition">
                    Upload Image
                    <i class="fa-solid fa-upload"></i>
                    <input type="file" class="hidden">
                </label>
            </div>

            <!-- RIGHT : FORM -->
            <div class="lg:col-span-2 space-y-8">

                <div class="relative">
                    <input type="text" name="name" placeholder="Enter your name"
                        class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Name
                    </label>
                </div>

                <div class="relative">
                    <input type="email" name="email" placeholder="Enter your email"
                        class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Email
                    </label>
                </div>

                <div class="relative">
                    <select name="country"
                        class="peer bg-white w-full border border-lightGrey rounded-md
               px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
               text-darkGrey"
                        required>
                        <option value="" disabled selected hidden></option>
                        <option value="id">Indonesia</option>
                        <option value="au">Australia</option>
                        <option value="us">United States</option>
                    </select>

                    <label
                        class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white
               peer-focus:text-darkGreen">
                        Country
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

    <div class="relative">
        <input type="text" name="tour" placeholder="Tour Package"
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
               text-2xl text-gray-300">

        <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
        <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
        <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
        <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
        <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"></i>
    </div>
</div>

</div>

                <div class="relative">
                    <textarea name="message" rows="7"
                        placeholder="Share your experience with us... What did you enjoy most? Would you recommend us to others?"
                        class="bg-white w-full border border-lightGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen"></textarea>
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                        Testimonial
                    </label>
                </div>

                <div class="flex items-start gap-3 text-sm text-darkGrey relative -top-2">
                    <input type="checkbox" class="mt-1">
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
@endpush
