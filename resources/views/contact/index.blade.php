@extends('layout.app')

@section('title', __('contact.title'))

<style>
    input::placeholder,
    textarea::placeholder {
        font-size: 0.75rem;
    }
</style>

@section('content')

    <!-- ================= HERO ABOUT ================= -->
    <section class="relative h-[380px] md:h-[420px] flex items-center justify-center">

        <!-- Background Image -->
        <img src="/images/contact-hero.png" alt="Contact Hero" class="absolute inset-0 w-full h-full object-cover">

        <!-- Title -->
        <h1 class="relative z-10 text-white text-3xl md:text-4xl font-semibold">
            {{ __('contact.hero_title_1') }} <span class="text-lightGreen">{{ __('contact.hero_title_2') }}</span>
        </h1>
    </section>

    <!-- ================= CONTACT CONTENT ================= -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- LEFT : CONTACT INFO -->
            <div>
                <p class="text-red font-semibold tracking-widest mb-6">
                    {{ __('contact.label_contact') }}
                </p>
                <h2 class="text-3xl md:text-4xl font-semibold text-darkGreen mb-4">
                    {{ __('contact.heading') }}
                </h2>
                <p class="text-darkGrey leading-relaxed mb-10">
                    {{ __('contact.description') }}
                </p>

                <!-- PHONE -->
                <div class="mb-8">
                    <p class="font-medium text-darkGrey mb-3">{{ __('contact.phone') }}:</p>

                    <div class="flex flex-wrap gap-8">
                        @foreach ($phones as $phone)
                            <div class="flex flex-col gap-2">
                                @if ($phone->label)
                                    <span class="text-sm font-semibold">
                                        {{ $phone->label }}
                                    </span>
                                @endif

                                <a href="tel:{{ app()->getLocale() == 'id' ? $phone->value_id : $phone->value_en }}"
                                    class="border border-darkGreen rounded-lg px-6 py-3
                          flex items-center gap-3
                          hover:bg-darkGreen/10 transition">
                                    <i class="fa-solid fa-phone text-darkGreen text-sm"></i>
                                    <span class="text-sm font-medium text-darkGrey">
                                        {{ app()->getLocale() == 'id' ? $phone->value_id : $phone->value_en }}
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- EMAIL -->
                <div>
                    <p class="font-medium text-darkGrey mb-3">{{ __('contact.email') }}:</p>

                    <ul class="space-y-4">
                        @foreach ($emails as $email)
                            <li class="flex flex-col gap-1">
                                @if ($email->label)
                                    <span class="text-sm font-semibold">
                                        {{ $email->label }}
                                    </span>
                                @endif

                                <a href="mailto:{{ app()->getLocale() == 'id' ? $email->value_id : $email->value_en }}"
                                    class="flex items-center gap-3
                          text-sm text-darkGrey font-medium
                          hover:text-darkGreen transition">
                                    <i class="fa-solid fa-envelope text-darkGreen text-sm"></i>
                                    {{ app()->getLocale() == 'id' ? $email->value_id : $email->value_en }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <!-- RIGHT : CONTACT FORM -->
            <div class="bg-softGrey rounded-3xl shadow-xl p-8 border-r-4 border-b-4 border-lightGreen">

                {{-- ================= ALERT ================= --}}
                @if (session('success'))
                    <div class="mb-6 rounded-lg bg-lightGreen/20 border border-darkGreen/80 p-4 text-darkGreen text-sm">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                @if ($errors->has('message'))
                    <p class="mb-6 rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm">
                        {{ $errors->first('message') }}
                    </p>
                @endif

                <h3 class="text-xl font-semibold mb-8">{{ __('contact.send_message') }}</h3>

                <form action="{{ route('contact.messages.store') }}" method="POST">
                    @csrf

                    <!-- NAME -->
                    <div class="relative mb-7">
                        <input type="text" name="name"
                            @auth
value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
        readonly @endauth
                            placeholder="{{ __('contact.placeholder_name') }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">{{ __('contact.name') }}</label>
                    </div>

                    <!-- EMAIL -->
                    <div class="relative mb-7">
                        <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}"
                            @auth readonly @endauth placeholder="{{ __('contact.placeholder_email') }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">{{ __('contact.email_label') }}</label>
                    </div>

                    <!-- PHONE -->
                    <div class="relative mb-7">
                        <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                            @auth readonly @endauth placeholder="{{ __('contact.placeholder_phone') }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">{{ __('contact.phone_number') }}</label>
                    </div>

                    <!-- MESSAGE -->
                    <div class="relative mb-6">
                        <textarea name="message" rows="7" placeholder="{{ __('contact.placeholder_message') }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 pt-4 text-sm focus:outline-none focus:border-darkGreen"
                            required></textarea>
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">{{ __('contact.message') }}</label>
                    </div>

                    <!-- BUTTON -->
                    @guest
                        <a href="{{ route('login') }}"
                            class="w-full bg-darkGreen text-white rounded-lg py-3 font-medium flex items-center justify-center gap-2 hover:bg-darkGreen/90 transition">
                            {{ __('contact.send_button') }}
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </a>
                    @endguest

                    @auth
                        <button type="submit"
                            class="w-full bg-darkGreen text-white rounded-lg py-3 font-medium flex items-center justify-center gap-2 hover:bg-darkGreen/90 transition">
                            {{ __('contact.send_button') }}
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </button>
                    @endauth

                </form>

            </div>
        </div>

        <!-- ADDRESS -->
        <div class="mt-8">
            <p class="font-medium text-darkGrey mb-3">{{ __('contact.address') }}:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach ($offices as $office)
                    @php
                        $officeName = $office->firstWhere('type', 'office_name');
                        $address = $office->firstWhere('type', 'address');
                        $map = $office->firstWhere('type', 'map_embed');
                    @endphp

                    <div>
                        <p class="text-sm font-semibold mb-3">
                            {{ app()->getLocale() == 'id' ? $officeName?->value_id : $officeName?->value_en }}
                        </p>

                        <div class="flex items-start gap-3 mb-6">
                            <i class="fa-solid fa-location-dot text-darkGreen text-base mt-1"></i>
                            <p class="text-sm text-darkGrey font-medium leading-relaxed">
                                {{ app()->getLocale() == 'id' ? $address?->value_id : $address?->value_en }}
                            </p>
                        </div>

                        @if ($map)
                            <iframe class="w-full h-[260px] rounded-sm" src="{{ app()->getLocale() == 'id' ? $map->value_id : $map->value_en }}" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
