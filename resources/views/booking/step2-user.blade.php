@extends('layout.authentication')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-12">

        <!-- ================= BACK & STEPPER ================= -->
        <div class="mb-16">
            <a href="{{ route('booking.step1') }}"
                class="flex items-center gap-2 text-darkGrey text-lg hover:text-mediumGrey mb-10">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <!-- Stepper -->
            <div class="max-w-3xl mx-auto">
                <div class="relative flex items-start justify-between">

                    <!-- LINE -->
                    <div class="absolute top-4 left-12 right-4 h-0.5 bg-lightGrey">
                        <div class="h-full w-1/2 bg-darkGreen"></div>
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
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-lightGrey text-mediumGrey z-10 font-medium">
                            3
                        </span>
                        <span class="mt-3 text-sm font-semibold text-mediumGrey/50">
                            Payment
                        </span>
                    </div>

                </div>
            </div>

        </div>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

            <!-- ================= LEFT FORM ================= -->
            <div class="space-y-10">

                <!-- When you will visit -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Please check your details</h3>

                    <div class="w-full">
                        <!-- Name -->
                        <div class="relative mt-6 mb-6">
                            <input type="text" name="name"
                                value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                                Name
                            </label>
                        </div>

                        <!-- Email -->
                        <div class="relative mb-6">
                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                                Email
                            </label>
                        </div>

                        <!-- Phone Number -->
                        <div class="relative">
                            <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                                Phone Number
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ================= RIGHT ORDER SUMMARY ================= -->
            <div class="border border-mediumGrey/50 rounded-3xl p-8 space-y-6 w-full">

                <h3 class="text-lg font-semibold">Your Orders Overview</h3>

                <div class="flex gap-4">
                    <img src="{{ asset('storage/' . $package->image_url) }}"
                        class="w-28 h-20 md:w-32 md:h-20 rounded-xl object-cover">

                    <div class="space-y-2">
                        <h4 class="font-semibold">{{ app()->getLocale() === 'id' ? $package->name_id : $package->name_en }}
                        </h4>

                        <div class="flex items-center gap-2 text-sm text-darkGreen">
                            <i class="fa-solid fa-calendar"></i>
                            {{ $fromDate->format('d M Y') }}
                        </div>

                        <div class="flex items-center gap-2 text-sm text-darkGreen">
                            <i class="fa-solid fa-clock"></i>
                            {{ $package->duration }}
                            {{ $package->duration == 1 ? 'day' : 'days' }}
                        </div>
                    </div>
                </div>

                <hr>

                <div class="flex justify-between text-sm">
                    <div class="flex items-center gap-2 text-mediumGrey">
                        <span class="w-6 h-6 rounded-full bg-lightGrey flex items-center justify-center text-mediumGrey">
                            {{ $booking['guests'] }}
                        </span>
                        Guests
                    </div>
                    <span
                        class="font-medium text-darkGrey">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>

                <hr>

                <div class="flex justify-between font-semibold text-darkGrey">
                    <span>Total Price</span>
                    <span
                        class="text-darkGreen">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>

                <div class="pt-2">
                    <form action="{{ route('booking.step3') }}" method="GET">
                        <button class="w-full bg-darkGreen hover:bg-darkGreen/90 text-white py-3 rounded-full font-medium">
                            Go to the Next Step
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
@endpush
