@extends('layout.authentication')

<style>
    input::placeholder {
        font-size: 0.75rem;
    }
</style>

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-white px-6">

        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-12">

            {{-- LEFT IMAGE --}}
            <div class="flex justify-center pt-2 mt-6 md:mt-0">
                <div class="relative w-full md:max-w-lg h-[88vh] max-h-[800px] rounded-3xl overflow-hidden">
                    <img id="sliderImage" src="{{ asset('images/bali1.png') }}" alt="Bali"
                        class="w-full h-full object-cover" />

                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        <span class="w-6 h-2 bg-lightGreen rounded-full cursor-pointer"
                            data-img="{{ asset('images/bali1.png') }}"></span>
                        <span class="w-2 h-2 bg-white rounded-full cursor-pointer"
                            data-img="{{ asset('images/bali2.png') }}"></span>
                        <span class="w-2 h-2 bg-white rounded-full cursor-pointer"
                            data-img="{{ asset('images/bali3.png') }}"></span>
                    </div>
                </div>
            </div>

            {{-- RIGHT FORM --}}
            <div class="flex flex-col justify-start w-full">

                {{-- Back --}}
                <a href="{{ url()->previous() }}"
                    class="flex items-center gap-3 text-mediumGrey mt-6 mb-6 font-medium hover:text-mediumGrey/80 transition">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                    <span>{{ __('auth.back') }}</span>
                </a>

                {{-- Logo --}}
                <div class="flex items-center gap-2 mb-6">
                    <img src="{{ asset('images/logo.png') }}" class="w-32 h-auto">
                </div>

                {{-- Title --}}
                <h1 class="text-3xl font-semibold mb-4">{{ __('auth.signup_title') }}</h1>
                <p class=" text-sm text-mediumGrey mb-8">
                    {{ __('auth.signup_desc') }}
                </p>

                {{-- Form --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- First & Last Name --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        {{-- First Name --}}
                        <div>
                            <div class="relative">
                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                    placeholder="{{ __('auth.enter_first_name') }}" required
                                    class="w-full border border-mediumGrey rounded-md px-3 h-12 text-sm
                       focus:outline-none focus:border-darkGreen" />

                                <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                                    {{ __('auth.first_name') }}
                                </label>
                            </div>

                            @error('first_name')
                                <p class="text-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div>
                            <div class="relative">
                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                    placeholder="{{ __('auth.enter_last_name') }}" required
                                    class="w-full border border-mediumGrey rounded-md px-3 h-12 text-sm
                       focus:outline-none focus:border-darkGreen" />

                                <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                                    {{ __('auth.last_name') }}
                                </label>
                            </div>

                            @error('last_name')
                                <p class="text-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Email & Phone --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        {{-- Email --}}
                        <div>
                            <div class="relative">
                                <input type="email" name="email" placeholder="{{ __('auth.enter_email') }}"
                                    value="{{ old('email') }}" required
                                    class="w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen" />
                                <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                                    {{ __('auth.email') }}
                                </label>
                            </div>
                            @error('email')
                                <p class="text-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <div class="relative">
                                <input type="text" name="phone" id="phone" placeholder="{{ __('auth.enter_phone') }}"
                                    value="{{ old('phone') }}" required
                                    class="w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen" />
                                <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                                    {{ __('auth.phone') }}
                                </label>
                            </div>
                            {{-- BACKEND ERROR --}}
                            @error('phone')
                                <p class="text-red text-sm mt-1">{{ $message }}</p>
                            @else
                                {{-- FRONTEND ERROR --}}
                                <p id="phoneError" class="text-red text-sm mt-1 hidden">
                                    {{ __('auth.invalid_phone') }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="{{ __('auth.enter_password') }}" required
                                class="w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen" />
                            <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                                {{ __('auth.password') }}
                            </label>
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                                <i class="fa-solid fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-5">
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="confirmPassword" required
                                placeholder="{{ __('auth.confirm_your_password') }}"
                                class="w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen" />

                            <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                                {{ __('auth.confirm_password') }}
                            </label>

                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
                                onclick="toggleConfirmPassword()">
                                <i class="fa-solid fa-eye" id="eyeIconConfirm"></i>
                            </button>
                        </div>
                        {{-- BACKEND ERROR --}}
                        @error('password')
                            <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @else
                            {{-- FRONTEND ERROR --}}
                            <p id="passwordMatchError" class="text-red text-sm mt-1 hidden">
                                {{ __('auth.password_not_match') }}
                            </p>
                        @enderror
                    </div>

                    {{-- Terms --}}
                    <div class="mb-8">
                        <div class="flex items-start gap-2">
                            <input type="checkbox" name="terms" class="mt-1" required>
                            <p class="text-sm">
                                {{ __('auth.agree_terms') }}
                                <a href="{{ route('terms') }}" target="_blank" class="text-darkGreen font-medium">{{ __('auth.terms') }}</a>
                                {{ __('auth.and') }}
                                <a href="{{ route('privacy') }}" target="_blank" class="text-darkGreen font-medium">{{ __('auth.privacy') }}</a>
                            </p>
                        </div>

                        @error('terms')
                            <p class="text-red text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full bg-darkGreen text-white py-3 rounded-md font-semibold hover:bg-darkGreen/95 transition">
                        {{ __('auth.signup_button') }}
                    </button>

                    <p class="text-center text-sm mt-4 mb-6 md:mb-0">
                        {{ __('auth.have_account') }}
                        <a href="{{ route('login') }}"
                            class="text-darkGreen font-medium underline hover:text-darkGreen/80 transition">
                            {{ __('auth.login') }}
                        </a>
                    </p>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        //Toggle Password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function toggleConfirmPassword() {
            const input = document.getElementById('confirmPassword');
            const icon = document.getElementById('eyeIconConfirm');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        //Phone Number
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phoneError');

        const phoneRegex = /^\+?[0-9]{8,15}$/;

        // cek saat selesai ngetik / pindah field
        phoneInput.addEventListener('blur', () => {
            if (!phoneInput.value) {
                phoneError.classList.add('hidden');
                return;
            }

            if (!phoneRegex.test(phoneInput.value)) {
                phoneError.classList.remove('hidden');
            } else {
                phoneError.classList.add('hidden');
            }
        });

        // hilangkan error saat user fokus lagi
        phoneInput.addEventListener('focus', () => {
            phoneError.classList.add('hidden');
        });

        // Password Confirmation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const error = document.getElementById('passwordMatchError');

        function checkPasswordMatch() {
            if (!password.value || !confirmPassword.value) {
                error.classList.add('hidden');
                return;
            }

            if (password.value !== confirmPassword.value) {
                error.classList.remove('hidden');
            } else {
                error.classList.add('hidden');
            }
        }

        // cek saat kursor KELUAR dari field
        password.addEventListener('blur', checkPasswordMatch);
        confirmPassword.addEventListener('blur', checkPasswordMatch);

        // hilangkan error saat user fokus lagi
        confirmPassword.addEventListener('focus', () => {
            error.classList.add('hidden');
        });

        // Slider Image
        const indicators = document.querySelectorAll('[data-img]');
        const sliderImage = document.getElementById('sliderImage');
        let currentIndex = 0;
        const total = indicators.length;

        function updateSlider(index) {
            // Ganti gambar
            const indicator = indicators[index];
            sliderImage.src = indicator.dataset.img;

            // Update semua indikator: kecil & putih
            indicators.forEach(i => {
                i.classList.remove('w-6', 'h-2', 'bg-lightGreen');
                i.classList.add('w-2', 'h-2', 'bg-white');
            });

            // Set indikator aktif: besar & hijau
            indicator.classList.remove('w-2', 'h-2', 'bg-white');
            indicator.classList.add('w-6', 'h-2', 'bg-lightGreen');
        }

        // Event klik indikator
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                updateSlider(currentIndex);
            });
        });

        // Slider otomatis tiap 5 detik
        setInterval(() => {
            currentIndex = (currentIndex + 1) % total;
            updateSlider(currentIndex);
        }, 5000);
    </script>
@endpush
