@extends('layout.app')

@section('title', 'Contact Us')

@section('content')

    <!-- ================= HERO ABOUT ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/contact-hero.png" alt="Contact Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-white text-3xl md:text-4xl font-semibold">
            Contact <span class="text-lightGreen">Us</span>
        </h1>
    </section>

    <!-- ================= CONTACT CONTENT ================= -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- LEFT : CONTACT INFO -->
            <div>
                <p class="text-red font-semibold tracking-widest mb-6">
                    CONTACT
                </p>
                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    Get In Touch
                </h2>
                <p class="text-darkGrey leading-relaxed mb-10">
                    Contact us easily and quickly for a comfortable and responsive communication experience.
                </p>

                <!-- PHONE -->
                <div class="mb-8">
                    <p class="font-medium text-darkGrey mb-3">Phone:</p>
                    <div class="flex flex-wrap gap-8">

                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">
                                Admin 1
                            </span>

                            <a href="tel:+6281353187669"
                                class="border border-darkGreen rounded-lg px-6 py-3
               flex items-center gap-3
               hover:bg-darkGreen/10 transition">
                                <i class="fa-solid fa-phone text-darkGreen text-sm"></i>
                                <span class="text-sm font-medium text-darkGrey">
                                    +62 813 5318 7669
                                </span>
                            </a>
                        </div>

                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">
                                Admin 2
                            </span>

                            <a href="tel:+6287828383205"
                                class="border border-darkGreen rounded-lg px-6 py-3
               flex items-center gap-3
               hover:bg-darkGreen/10 transition">
                                <i class="fa-solid fa-phone text-darkGreen text-sm"></i>
                                <span class="text-sm font-medium text-darkGrey">
                                    +62 8782 8383 205
                                </span>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- EMAIL -->
                <div>
                    <p class="font-medium text-darkGrey mb-3">Email:</p>
                    <ul class="space-y-4">
                        <!-- EMAIL 1 -->
                        <li class="flex flex-col gap-1">
                            <span class="text-sm font-semibold">
                                Email 1
                            </span>

                            <a href="mailto:baliedutours@gmail.com"
                                class="flex items-center gap-3 text-sm text-darkGrey font-medium hover:text-darkGreen transition">
                                <i class="fa-solid fa-envelope text-darkGreen text-sm"></i>
                                baliedutours@gmail.com
                            </a>
                        </li>

                        <!-- EMAIL 2 -->
                        <li class="flex flex-col gap-1">
                            <span class="text-sm font-semibold">
                                Email 2
                            </span>

                            <a href="mailto:info@baliedutours.com"
                                class="flex items-center gap-3 text-sm text-darkGrey font-medium hover:text-darkGreen transition">
                                <i class="fa-solid fa-envelope text-darkGreen text-sm"></i>
                                info@baliedutours.com
                            </a>
                        </li>

                        <!-- EMAIL 3 -->
                        <li class="flex flex-col gap-1">
                            <span class="text-sm font-semibold">
                                Email 3
                            </span>

                            <a href="mailto:hellobaliedu@gmail.com"
                                class="flex items-center gap-3 text-sm text-darkGrey font-medium hover:text-darkGreen transition">
                                <i class="fa-solid fa-envelope text-darkGreen text-sm"></i>
                                hellobaliedu@gmail.com
                            </a>
                        </li>

                        <!-- EMAIL 4 -->
                        <li class="flex flex-col gap-1">
                            <span class="text-sm font-semibold">
                                Email 4
                            </span>

                            <a href="mailto:marketing@baliedutours.com"
                                class="flex items-center gap-3 text-sm text-darkGrey font-medium hover:text-darkGreen transition">
                                <i class="fa-solid fa-envelope text-darkGreen text-sm"></i>
                                marketing@baliedutours.com
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- RIGHT : CONTACT FORM -->
            <div class="bg-softGrey rounded-3xl shadow-xl p-8 border-r-4 border-b-4 border-lightGreen">

                <h3 class="text-xl font-semibold mb-8">Send Us a Message</h3>

                <form>

                    <div class="relative mb-7">
                        <input type="text" name="name" placeholder="Enter your name"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Name
                        </label>
                    </div>

                    <div class="relative mb-7">
                        <input type="email" name="email" placeholder="Enter your email"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Email
                        </label>
                    </div>

                    <div class="relative mb-7">
                        <input type="text" name="phone" placeholder="Enter your phone number"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Phone Number
                        </label>
                    </div>

                    <div class="relative mb-6">
                        <textarea name="message" rows="7" placeholder="Tell us about your inquiry..."
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen"></textarea>
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Message
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-darkGreen text-white rounded-lg py-3 font-medium flex items-center justify-center gap-2 hover:bg-darkGreen/90 transition">
                        Send Message
                        <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>

                </form>
            </div>
        </div>

        <!-- ADDRESS -->
        <div class="mt-8">
            <p class="font-medium text-darkGrey mb-3">Address:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <!-- HEAD OFFICE -->
                <div>
                    <p class="text-sm font-semibold mb-3">Head Office</p>
                    <div class="flex items-center gap-3 mb-6">
    <i class="fa-solid fa-location-dot text-darkGreen text-base"></i>
    <p class="text-sm text-darkGrey font-medium leading-relaxed">
        Dukuh Krajan Kulon RT003 / RW001, Desa Karangnongko,
        Kecamatan Nalumsari, Kabupaten Jepara – Jawa Tengah
    </p>
</div>

                    <iframe class="w-full h-[260px] rounded-sm" src="https://www.google.com/maps?q=Jepara&output=embed">
                    </iframe>
                </div>

                <!-- BALI OFFICE -->
                <div>
                    <p class="text-sm font-semibold mb-3">Bali Office</p>
                    <div class="flex items-center gap-3 mb-6">
    <i class="fa-solid fa-location-dot text-darkGreen text-base"></i>
    <p class="text-sm text-darkGrey font-medium leading-relaxed">
        Jl. Pasekan Gg. Batubara 26, Desa Batubulan,
        Kecamatan Sukawati, Kabupaten Gianyar – Bali
    </p>
</div>

                    <iframe class="w-full h-[260px] rounded-sm"
                        src="https://www.google.com/maps?q=Gianyar+Bali&output=embed">
                    </iframe>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
@endpush
