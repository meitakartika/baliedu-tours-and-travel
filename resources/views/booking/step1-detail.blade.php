@extends('layout.authentication')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-12">

        <!-- ================= BACK & STEPPER ================= -->
        <div class="mb-16">
            <a href="{{ route('tours.show', $package->id) }}"
                class="flex items-center gap-2 text-darkGrey text-lg hover:text-mediumGrey mb-10">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <!-- Stepper -->
            <div class="max-w-3xl mx-auto">
                <div class="relative flex items-start justify-between">

                    <!-- LINE -->
                    <div class="absolute top-4 left-12 right-4 h-0.5 bg-lightGrey"></div>

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
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-lightGrey text-mediumGrey z-10 font-medium">
                            2
                        </span>
                        <span class="mt-3 text-sm font-semibold text-mediumGrey/50">
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
                    <h3 class="text-lg font-semibold mb-4">When you will visit?</h3>

                    <div class="w-full">
                        <!-- From -->
                        <div class="relative mt-6 mb-6">
                            <input type="date" id="fromDate" value="{{ $fromDate->format('Y-m-d') }}"
                                class="bg-white w-full border border-mediumGrey/30 rounded-md
               p-3 text-sm h-12
               focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                                From
                            </label>
                        </div>

                        <!-- To -->
                        <div class="relative">
                            <input type="date" id="toDate" value="{{ $toDate->format('Y-m-d') }}" readonly
                                class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                                To
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Number of Guests -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Number of Guests</h3>

                    <div class="flex items-center justify-between border border-mediumGrey/30 rounded-lg px-4 py-3 w-full">

                        <span class="text-darkGreen font-semibold" id="pricePerGuest">
                            Rp{{ number_format($package->price, 0, ',', '.') }}
                        </span>

                        <div class="flex items-center border border-lightGrey rounded-md overflow-hidden">

                            <!-- MINUS -->
                            <button type="button" id="minusBtn"
                                class="w-8 h-8 flex items-center justify-center text-darkGrey text-sm hover:bg-lightGrey">
                                <i class="fa-solid fa-minus"></i>
                            </button>

                            <!-- DIVIDER -->
                            <div class="w-px bg-lightGrey"></div>

                            <!-- NUMBER -->
                            <span id="guestCount"
                                class="w-8 h-8 flex items-center justify-center bg-lightGrey font-medium text-darkGrey text-sm">
                                {{ session('booking.guests') }}
                            </span>

                            <!-- DIVIDER -->
                            <div class="w-px bg-lightGrey"></div>

                            <!-- PLUS -->
                            <button type="button" id="plusBtn"
                                class="w-8 h-8 flex items-center justify-center text-sm text-darkGrey hover:bg-lightGrey">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>
                    </div>
                </div>

            </div>

            <!-- ================= RIGHT ORDER SUMMARY ================= -->
            <div class="border border-mediumGrey/50 rounded-3xl p-8 space-y-6 w-full">

                <h3 class="text-lg font-semibold">Your Orders Overview</h3>

                <!-- PACKAGE INFO -->
                <div class="flex gap-4">
                    <img src="{{ asset('storage/' . $package->image_url) }}"
                        class="w-28 h-20 md:w-32 md:h-20 rounded-xl object-cover">

                    <div class="space-y-2">
                        <h4 class="font-semibold">{{ app()->getLocale() === 'id' ? $package->name_id : $package->name_en }}
                        </h4>

                        <div class="flex items-center gap-2 text-sm text-darkGreen">
                            <i class="fa-solid fa-calendar"></i>
                            <span id="overviewDate">
                                {{ $fromDate->format('d M Y') }}
                            </span>
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
                        <span id="overviewGuests"
                            class="w-6 h-6 rounded-full bg-lightGrey flex items-center justify-center text-mediumGrey">
                            {{ $guests }}
                        </span>
                        Guests
                    </div>
                    <span id="overviewSubtotal" class="font-medium text-darkGrey">
                        Rp{{ number_format($package->price * $guests, 0, ',', '.') }}
                    </span>
                </div>

                <hr>

                <div class="flex justify-between font-semibold text-darkGrey">
                    <span>Total Price</span>
                    <span id="overviewTotal" class="text-darkGreen">
                        Rp{{ number_format($package->price * $guests, 0, ',', '.') }}
                    </span>
                </div>

                <div class="pt-2">
                    <form action="{{ route('booking.storeStep1') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" id="inputDate" value="{{ $fromDate->format('Y-m-d') }}">
                        <input type="hidden" name="guests" id="inputGuests" value="{{ $guests }}">
                        <button type="submit"
                            class="w-full bg-darkGreen hover:bg-darkGreen/90 text-white py-3 rounded-full font-medium">
                            Go to the Next Step
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Duration
        const duration = {{ $package->duration }};
        const fromInput = document.getElementById('fromDate');
        const toInput = document.getElementById('toDate');

        const overviewDate = document.getElementById('overviewDate');

        function updateToDate() {
            if (!fromInput.value) return;

            const fromDate = new Date(fromInput.value);
            const toDate = new Date(fromDate);
            toDate.setDate(fromDate.getDate() + duration - 1);

            toInput.value = toDate.toISOString().split('T')[0];
            overviewDate.textContent = formatDate(fromInput.value);
        }

        fromInput.addEventListener('change', () => {
            updateToDate();
            document.getElementById('inputDate').value = fromInput.value;
        });

        // Guests & Price
        let guests = {{ session('booking.guests') }};
        const minGuests = {{ $package->guest_min }};
        const maxGuests = {{ $package->guest_max }};
        const price = {{ $package->price }};

        const guestCount = document.getElementById('guestCount');
        const overviewGuests = document.getElementById('overviewGuests');
        const overviewSubtotal = document.getElementById('overviewSubtotal');
        const overviewTotal = document.getElementById('overviewTotal');

        function updatePrice() {
            const total = price * guests;

            guestCount.textContent = guests;
            overviewGuests.textContent = guests;

            overviewSubtotal.textContent = formatRupiah(total);
            overviewTotal.textContent = formatRupiah(total);

            document.getElementById('inputGuests').value = guests;
        }

        document.getElementById('plusBtn').addEventListener('click', () => {
            if (guests < maxGuests) {
                guests++;
                updatePrice();
            }
        });

        document.getElementById('minusBtn').addEventListener('click', () => {
            if (guests > minGuests) {
                guests--;
                updatePrice();
            }
        });
        updatePrice();

        // HELPERS
        function formatRupiah(number) {
            return 'Rp' + number.toLocaleString('id-ID');
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }
    </script>
@endpush
