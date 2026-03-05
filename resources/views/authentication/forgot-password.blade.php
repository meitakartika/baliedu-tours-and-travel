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
                    class="flex items-center gap-3 text-mediumGrey mt-6 mb-8 font-medium hover:text-mediumGrey/80 transition">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                    <span>{{ __('auth.back') }}</span>
                </a>

                {{-- Logo --}}
                <div class="flex items-center gap-2 mb-8">
                    <img src="{{ asset('images/logo.png') }}" class="w-32 h-auto">
                </div>

                {{-- Title --}}
                <h1 class="text-3xl font-semibold mb-4">{{ __('auth.forgot_title') }}</h1>
                <p class=" text-sm text-mediumGrey mb-8">
                    {{ __('auth.forgot_desc') }}
                </p>

                {{-- Form --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    @error('email')
                        <p class="text-sm text-red mb-2">{{ $message }}</p>
                    @enderror

                    <div class="mb-8 relative">
                        <input type="email" name="email" placeholder="{{ __('auth.enter_email') }}"
                            class="w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" value="{{ old('email') }}" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                            {{ __('auth.email') }}
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-darkGreen text-white py-3 mt-4 mb-6 md:mb-0 rounded-md font-semibold hover:bg-darkGreen/95 transition">
                        {{ __('auth.send_reset_link') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
