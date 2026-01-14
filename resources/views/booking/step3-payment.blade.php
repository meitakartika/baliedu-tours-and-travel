@extends('layout.authentication')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-12">

        <!-- ================= BACK & STEPPER ================= -->
        <div class="mb-16">
            <a href="#" class="flex items-center gap-2 text-darkGrey text-lg hover:text-mediumGrey mb-10">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <!-- Stepper -->
            <div class="max-w-3xl mx-auto">
                <div class="relative flex items-start justify-between">

                    <!-- LINE -->
                    <div class="absolute top-4 left-12 right-4 h-0.5 bg-darkGreen">
                    </div>

                    <!-- STEP 1 -->
                    <div class="relative flex flex-col items-center text-center">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-darkGreen text-white z-10 font-medium">
                            1
                        </span>
                        <span class="mt-3 text-sm font-semibold text-darkGreen">
                            Booking Details
                        </span>
                    </div>

                    <!-- STEP 2 -->
                    <div class="relative flex flex-col items-center text-center">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-darkGreen text-white z-10 font-medium">
                            2
                        </span>
                        <span class="mt-3 text-sm font-semibold text-darkGreen">
                            Your Details
                        </span>
                    </div>

                    <!-- STEP 3 -->
                    <div class="relative flex flex-col items-center text-center">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-darkGreen text-white z-10 font-medium">
                            3
                        </span>
                        <span class="mt-3 text-sm font-semibold text-darkGreen">
                            Payment
                        </span>
                    </div>

                </div>
            </div>

        </div>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            <!-- ================= LEFT PAYMENT ================= -->
            <div class="space-y-10">

                <!-- PAYMENT TERMS -->
                <div class="bg-white rounded-2xl shadow-lg p-6 space-y-4">
                    <h3 class="font-semibold text-darkGrey">Payment Terms</h3>

                    <ul class="list-disc list-outside pl-5 text-sm text-darkGrey space-y-2">
                        <li>Full payment (100%) is required immediately after placing your order.</li>
                        <li>Bank transfer fees are the responsibility of the client.</li>
                        <li>Please upload your proof of payment on this page. Your reservation will be processed once the
                            payment is successfully verified.</li>
                    </ul>
                </div>

                <!-- BANK TRANSFER -->
                <div class="border border-mediumGrey/50 rounded-2xl p-6">
                    <h3 class="font-semibold text-darkGrey mb-6">Bank Transfer</h3>

                    <div class="space-y-6">
                    <!-- Bank Name -->
                    <div class="relative">
                            <input type="text" value="BCA KCP Sanur Raya" readonly
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                Bank Name
                            </label>
                    </div>

                    <!-- Account Number -->
                    <div class="relative">
                            <input type="text" value="6700 66 56 99" readonly
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                Account Number
                            </label>
                            <i
                                class="fa-solid fa-copy absolute right-3 top-1/2 -translate-y-1/2 text-darkGreen cursor-pointer"></i>
                    </div>

                    <!-- Account Name -->
                    <div class="relative">
                            <input type="text" value="Baliedu Tours and Travel CV" readonly
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                Account Name
                            </label>
                    </div>
                    </div>

                    <button class="flex items-center gap-2 text-sm text-darkGreen font-medium mt-4">
                        <i class="fa-solid fa-circle-question"></i>
                        How to Pay
                    </button>
                </div>

                <!-- UPLOAD PAYMENT PROOF -->
                <div>
                    <h3 class="font-semibold text-darkGrey mb-5">Upload Payment Proof</h3>

                    <div
                        class="w-40 h-32 md:w-60 md:h-36 bg-lightGrey rounded-xl flex items-center justify-center border border-dashed border-mediumGrey">
                        <i class="fa-regular fa-image text-2xl text-mediumGrey"></i>
                    </div>

                    <button
                        class="inline-flex items-center gap-2 border border-darkGreen text-darkGreen px-4 py-2 mt-7 rounded-md text-sm font-medium hover:bg-darkGreen hover:text-white transition">
                        Upload
                        <i class="fa-solid fa-upload"></i>
                    </button>
                </div>

            </div>

            <!-- ================= RIGHT ORDER SUMMARY ================= -->
            <div class="border border-mediumGrey/50 rounded-3xl p-8 space-y-6 w-full">

                <h3 class="text-lg font-semibold">Your Orders Overview</h3>

                <div class="flex gap-4">
                    <img src="/images/bali1.png" alt="Fireflies Tour"
                        class="w-28 h-20 md:w-32 md:h-20 rounded-xl object-cover">

                    <div class="space-y-2">
                        <h4 class="font-semibold">Fireflies Tour</h4>

                        <div class="flex items-center gap-2 text-sm text-darkGreen">
                            <i class="fa-solid fa-calendar"></i>
                            12 Nov 2025
                        </div>

                        <div class="flex items-center gap-2 text-sm text-darkGreen">
                            <i class="fa-solid fa-clock"></i>
                            1 day
                        </div>
                    </div>
                </div>

                <hr>

                <div class="flex justify-between text-sm">
                    <div class="flex items-center gap-2 text-mediumGrey">
                        <span class="w-6 h-6 rounded-full bg-lightGrey flex items-center justify-center text-mediumGrey">
                            2
                        </span>
                        Guests
                    </div>
                    <span class="font-medium text-darkGrey">Rp1.000.000,00</span>
                </div>

                <hr>

                <div class="flex justify-between font-semibold text-darkGrey">
                    <span>Total Price</span>
                    <span class="text-darkGreen">Rp1.000.000,00</span>
                </div>

                <div class="pt-2">
                    <button class="w-full bg-darkGreen hover:bg-darkGreen/90 text-white py-3 rounded-full font-medium">
                        Go to the Next Step
                    </button>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
@endpush
