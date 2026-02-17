@extends('layout.authentication')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-12">

        <!-- ================= BACK & STEPPER ================= -->
        <div class="mb-16">
            <a href="{{ route('booking.step2') }}"
                class="flex items-center gap-2 text-darkGrey text-lg hover:text-mediumGrey mb-10">
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

            <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data"
                class="contents">
                @csrf

                <!-- ================= LEFT PAYMENT ================= -->
                <div class="space-y-10">

                    <!-- PAYMENT TERMS -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 space-y-4">
                        <h3 class="font-semibold text-darkGrey">Payment Terms</h3>

                        <ul class="list-disc list-outside pl-5 text-sm text-darkGrey space-y-2">
                            <li>Full payment (100%) is required immediately after placing your order.</li>
                            <li>Bank transfer fees are the responsibility of the client.</li>
                            <li>Please upload your proof of payment on this page. Your reservation will be processed once
                                the
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
                                <input type="text" id="accountNumber" value="6700 66 56 99" readonly
                                    class="bg-white w-full border border-mediumGrey/30 rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-xs bg-white">
                                    Account Number
                                </label>
                                <i id="copyBtn"
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

                        <button type="button" onclick="openModal()"
                            class="flex items-center gap-2 text-sm text-darkGreen font-medium mt-4">
                            <i class="fa-solid fa-circle-question"></i>
                            How to Pay
                        </button>
                    </div>

                    <!-- UPLOAD PAYMENT PROOF -->
                    <div>
                        <h3 class="font-semibold text-darkGrey mb-5">Upload Payment Proof</h3>

                        <div id="previewBox"
                            class="w-40 h-32 md:w-60 md:h-36 bg-lightGrey rounded-xl 
           flex items-center justify-center border border-dashed border-mediumGrey overflow-hidden">
                            <i id="previewIcon" class="fa-regular fa-image text-2xl text-mediumGrey"></i>
                            <img id="previewImage" class="hidden w-full h-full object-cover" />
                        </div>

                        <input type="file" name="payment_proof" id="paymentInput" accept="image/*" class="hidden">

                        <button type="button" id="uploadBtn"
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
                                {{ $package->duration }} {{ $package->duration == 1 ? 'day' : 'days' }}
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
                            Guests
                        </div>
                        <span class="font-medium text-darkGrey">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-semibold text-darkGrey">
                        <span>Total Price</span>
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
                            Confirm & Send Booking
                        </button>
                    </div>

                </div>
            </form>

            <!-- CONFIRM BOOKING MODAL -->
            <div id="confirmModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

                <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">

                    <h2 class="text-lg font-semibold text-darkGrey mb-3">
                        Confirm Booking
                    </h2>

                    <p class="text-sm text-mediumGrey">
                        Are you sure you want to confirm this booking?
                    </p>
                        <p class="text-sm text-mediumGrey mb-6">
                        Please make sure your payment proof is correct.
                    </p>

                    <div class="flex justify-end gap-3">
                        <!-- Cancel -->
                        <button onclick="closeConfirmModal()"
                            class="px-4 py-2 rounded-lg border border-mediumGrey hover:bg-lightGrey">
                            Cancel
                        </button>

                        <!-- Yes Submit -->
                        <button onclick="submitBooking()"
                            class="px-4 py-2 rounded-lg bg-darkGreen text-white hover:bg-darkGreen/90">
                            Yes, Confirm
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
                        <h2 class="text-xl font-semibold text-darkGreen/80">Cara Pembayaran via Transfer Bank</h2>
                        <button onclick="closeModal()">
                            <i class="fa-solid fa-x text-mediumGrey"></i>
                        </button>
                    </div>

                    <!-- GARIS PUTUS -->
                    <div class="border-t-2 border-dashed border-darkGreen/40 mb-4"></div>

                    <!-- ISI LANGKAH -->
                    <ol class="list-decimal pl-6 space-y-2 text-darkGrey leading-relaxed">
                        <li>Buka layanan perbankan Anda (ATM, mobile banking, atau internet banking) dari bank mana pun.
                        </li>
                        <li>Pilih menu Transfer.</li>
                        <li>Pilih transfer ke bank tujuan: <b>BCA (Bank Central Asia)</b>.</li>
                        <li>Masukkan nomor rekening tujuan: <b>6700 66 56 99</b>.</li>
                        <li>Masukkan jumlah pembayaran sesuai total tagihan booking Anda.</li>
                        <li>Periksa kembali detail penerima, pastikan nama yang muncul adalah <b>Baliedu Tours and Travel
                                CV</b>.</li>
                        <li>Jika semua data sudah benar, konfirmasikan dan selesaikan transaksi.</li>
                        <li>Simpan bukti transfer (struk atau screenshot) lalu unggah sebagai bukti pembayaran pada halaman
                            booking.</li>
                    </ol>
                    <p class="mt-4 text-sm text-darkGrey">
                        <b>Catatan:</b> Jika Anda transfer dari bank lain (bukan BCA), mungkin akan dikenakan biaya
                        administrasi antar bank sesuai kebijakan bank pengirim.
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
                alert('Account number copied!');
            }).catch(() => {
                alert('Failed to copy');
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
