@extends('layout.authentication')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-12">

        <!-- ================= BACK & STEPPER ================= -->
        <div class="mb-16">
            <a href="{{ route('booking.step2') }}"
                class="flex items-center gap-2 text-darkGrey text-lg hover:text-mediumGrey mb-10">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('booking.back') }}
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
                            {{ __('booking.step1') }}
                        </span>
                    </div>

                    <!-- STEP 2 -->
                    <div class="relative flex flex-col items-center text-center">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-darkGreen text-white z-10 font-medium">
                            2
                        </span>
                        <span class="mt-3 text-sm font-semibold text-darkGreen">
                            {{ __('booking.step2') }}
                        </span>
                    </div>

                    <!-- STEP 3 -->
                    <div class="relative flex flex-col items-center text-center">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-darkGreen text-white z-10 font-medium">
                            3
                        </span>
                        <span class="mt-3 text-sm font-semibold text-darkGreen">
                            {{ __('booking.step3') }}
                        </span>
                    </div>

                </div>
            </div>

        </div>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data"
                class="contents">
                @csrf

                <!-- ================= LEFT PAYMENT ================= -->
                <div class="space-y-10">

                    <!-- PAYMENT TERMS -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 space-y-4">
                        <h3 class="font-semibold text-darkGrey">{{ __('booking.payment_terms') }}</h3>

                        <ul class="list-disc list-outside pl-5 text-sm text-darkGrey space-y-2">
                            <li>{{ __('booking.payment_term_1') }}</li>
                            <li>{{ __('booking.payment_term_2') }}</li>
                            <li>{{ __('booking.payment_term_3') }}</li>
                        </ul>
                    </div>

                    <!-- BANK TRANSFER -->
                    <div class="border border-mediumGrey/50 rounded-2xl p-6">
                        <h3 class="font-semibold text-darkGrey mb-6">{{ __('booking.bank_transfer') }}</h3>

                        <div class="space-y-6">
                            <!-- Bank Name -->
                            <div class="relative">
                                <input type="text" value="BCA KCP Sanur Raya" readonly
                                    class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                    {{ __('booking.bank_name') }}
                                </label>
                            </div>

                            <!-- Account Number -->
                            <div class="relative">
                                <input type="text" id="accountNumber" value="6700 66 56 99" readonly
                                    class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                    {{ __('booking.account_number') }}
                                </label>
                                <i id="copyBtn"
                                    class="fa-solid fa-copy absolute right-3 top-1/2 -translate-y-1/2 text-darkGreen cursor-pointer"></i>
                            </div>

                            <!-- Account Name -->
                            <div class="relative">
                                <input type="text" value="Baliedu Tours and Travel CV" readonly
                                    class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                    {{ __('booking.account_name') }}
                                </label>
                            </div>
                        </div>

                        <button type="button" onclick="openModal()"
                            class="flex items-center gap-2 text-sm text-darkGreen font-medium mt-4">
                            <i class="fa-solid fa-circle-question"></i>
                            {{ __('booking.how_to_pay') }}
                        </button>
                    </div>

                    <!-- UPLOAD PAYMENT PROOF -->
                    <div>
                        <h3 class="font-semibold text-darkGrey mb-5">{{ __('booking.upload_payment') }}</h3>

                        <div id="previewBox"
                            class="w-40 h-32 md:w-60 md:h-36 bg-lightGrey rounded-xl 
           flex items-center justify-center border border-dashed border-mediumGrey overflow-hidden">
                            <i id="previewIcon" class="fa-regular fa-image text-2xl text-mediumGrey"></i>
                            <img id="previewImage" class="hidden w-full h-full object-cover" />
                        </div>

                        <p class="text-xs text-mediumGrey mt-2">
                            {{ __('booking.payment_proof_note') }}
                        </p>

                        <input type="file" name="payment_proof" id="paymentInput" accept="image/*" class="hidden">

                        <button type="button" id="uploadBtn"
                            class="inline-flex items-center gap-2 border border-darkGreen text-darkGreen px-4 py-2 mt-5 rounded-md text-sm font-medium hover:bg-darkGreen hover:text-white transition">
                            {{ __('booking.upload') }}
                            <i class="fa-solid fa-upload"></i>
                        </button>
                    </div>

                </div>

                <!-- ================= RIGHT ORDER SUMMARY ================= -->
                <div class="border border-mediumGrey/50 rounded-3xl p-8 space-y-6 w-full">

                    <h3 class="text-lg font-semibold">{{ __('booking.overview_title') }}</h3>

                    <div class="flex gap-4">
                        <img src="{{ asset('storage/' . $package->image_url) }}"
                            class="w-28 h-20 md:w-32 md:h-20 rounded-xl object-cover">

                        <div class="space-y-2">
                            <h4 class="font-semibold">
                                {{ app()->getLocale() === 'id' ? $package->name_id : $package->name_en }}</h4>

                            <div class="flex items-center gap-2 text-sm text-darkGreen">
                                <i class="fa-solid fa-calendar"></i>
                                {{ $fromDate->format('d M Y') }}
                            </div>

                            <div class="flex items-center gap-2 text-sm text-darkGreen">
                                <i class="fa-solid fa-clock"></i>
                                {{ $package->duration }}
                                {{ $package->duration == 1 ? __('booking.day') : __('booking.days') }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="flex justify-between text-sm">
                        <div class="flex items-center gap-2 text-mediumGrey">
                            <span
                                class="w-6 h-6 rounded-full bg-lightGrey flex items-center justify-center text-mediumGrey">
                                {{ $guests }}
                            </span>
                            {{ __('booking.guests') }}
                        </div>
                        <span class="font-medium text-darkGrey">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-semibold text-darkGrey">
                        <span>{{ __('booking.total_price') }}</span>
                        <span class="text-darkGreen">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    {{-- error upload payment --}}
                    @error('payment_proof')
                        <div class="mb-4 p-3 rounded-lg bg-red/5 border border-red/80 text-red text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="pt-2">
                        <button type="button" onclick="openConfirmModal()"
                            class="w-full bg-darkGreen hover:bg-darkGreen/90 text-white py-3 rounded-full font-medium">
                            {{ __('booking.confirm_send_booking') }}
                        </button>
                    </div>

                </div>
            </form>

            <!-- CONFIRM BOOKING MODAL -->
            <div id="confirmModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

                <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">

                    <h2 class="text-lg font-semibold text-darkGrey mb-3">
                        {{ __('booking.confirm_booking_title') }}
                    </h2>

                    <p class="text-sm text-mediumGrey">
                        {{ __('booking.confirm_booking_text1') }}
                    </p>
                    <p class="text-sm text-mediumGrey mb-6">
                        {{ __('booking.confirm_booking_text2') }}
                    </p>

                    <div class="flex justify-end gap-3">
                        <!-- Cancel -->
                        <button onclick="closeConfirmModal()"
                            class="px-4 py-2 rounded-lg border border-mediumGrey hover:bg-lightGrey">
                            {{ __('booking.cancel') }}
                        </button>

                        <!-- Yes Submit -->
                        <button onclick="submitBooking()"
                            class="px-4 py-2 rounded-lg bg-darkGreen text-white hover:bg-darkGreen/90">
                            {{ __('booking.yes_confirm') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- PAY MODAL -->
            <div id="payModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

                <!-- BOX MODAL -->
                <div class="bg-white w-full max-w-2xl rounded-2xl border-2 border-darkGreen p-6 relative">

                    <!-- HEADER -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-darkGreen/80">{{ __('booking.payment_method_title') }}</h2>
                        <button onclick="closeModal()">
                            <i class="fa-solid fa-x text-mediumGrey"></i>
                        </button>
                    </div>

                    <!-- GARIS PUTUS -->
                    <div class="border-t-2 border-dashed border-darkGreen/40 mb-4"></div>

                    <!-- ISI LANGKAH -->
                    <ol class="list-decimal pl-6 space-y-2 text-darkGrey leading-relaxed">
                        <li>{{ __('booking.payment_step_1') }}</li>
                        <li>{{ __('booking.payment_step_2') }}</li>
                        <li>{{ __('booking.payment_step_3') }} <b>{{ __('booking.payment_step_9') }}</b>.</li>
                        <li>{{ __('booking.payment_step_4') }} <b>{{ __('booking.payment_step_10') }}</b>.</li>
                        <li>{{ __('booking.payment_step_5') }}</li>
                        <li>{{ __('booking.payment_step_6') }} <b>{{ __('booking.payment_step_11') }}</b>.</li>
                        <li>{{ __('booking.payment_step_7') }}</li>
                        <li>{{ __('booking.payment_step_8') }}</li>
                    </ol>
                    <p class="mt-4 text-sm text-darkGrey">
                        <b>{{ __('booking.note') }}</b> {{ __('booking.payment_note') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Copy Account Number
        const copyBtn = document.getElementById('copyBtn');
        const accountInput = document.getElementById('accountNumber');

        copyBtn.addEventListener('click', () => {
            const text = accountInput.value;

            navigator.clipboard.writeText(text).then(() => {
                alert('{{ __('booking.copied') }}');
            }).catch(() => {
                alert('{{ __('booking.copy_failed') }}');
            });
        });

        // How to Pay
        function openModal() {
            document.getElementById('payModal').classList.remove('hidden');
            document.getElementById('payModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('payModal').classList.add('hidden');
            document.getElementById('payModal').classList.remove('flex');
        }

        // Preview Payment
        const uploadBtn = document.getElementById('uploadBtn');
        const paymentInput = document.getElementById('paymentInput');
        const previewImage = document.getElementById('previewImage');
        const previewIcon = document.getElementById('previewIcon');

        // klik tombol Upload = buka file picker
        uploadBtn.addEventListener('click', () => {
            paymentInput.click();
        });

        // saat file dipilih, tampilkan preview
        paymentInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewIcon.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // OPEN MODAL
        function openConfirmModal() {
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
        }

        // CLOSE MODAL
        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }

        // SUBMIT FORM
        function submitBooking() {
            document.getElementById('bookingForm').submit();
        }
    </script>
@endpush
