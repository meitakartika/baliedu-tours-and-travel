@extends('layout.admin')

@section('title', __('admin.view_booking'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('bookings.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.view_booking') }}
        </h1>

        <!-- FORM -->
        <form method="POST" action="{{ route('bookings.update', $booking) }}" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">{{ __('admin.booking_details') }}</h2>
                <!-- Tour -->
                <div class="relative mt-1">
                    <input type="text" name="tour_package" readonly
                        value="{{ app()->getLocale() == 'id' ? $booking->package->name_id : $booking->package->name_en }}"
                        class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.tour_package') }}
                    </label>
                </div>

                <!-- Guests -->
                <div class="relative mt-1">
                    <input type="text" name="guests" readonly value="{{ $booking->guest_count }}"
                        class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.number_of_guests') }}
                    </label>
                </div>

                <!-- From -->
                <div class="relative mt-1">
                    <input type="date" name="from" readonly value="{{ $booking->tour_date->format('Y-m-d') }}"
                        class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.from') }}
                    </label>
                </div>

                <!-- To -->
                @php
                    $toDate = $booking->tour_date->copy()->addDays($booking->package->duration - 1);
                @endphp
                <div class="relative mt-1">
                    <input type="date" name="to" readonly value="{{ $toDate->format('Y-m-d') }}"
                        class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.to') }}
                    </label>
                </div>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">{{ __('admin.user_details') }}</h2>
                <!-- USER SECTION -->
                <div class="col-span-2 flex gap-8 items-center">

                    <!-- AVATAR -->
                    <div class="flex flex-col items-center gap-3 w-32">
                        @if ($booking->user->profile_image)
                            <img src="{{ asset('storage/' . $booking->user->profile_image) }}"
                                class="w-24 h-24 rounded-full object-cover">
                        @else
                            <div class="w-24 h-24 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-circle-user text-8xl text-darkGreen"></i>
                            </div>
                        @endif
                    </div>

                    <!-- INPUTS -->
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- NAME -->
                        <div class="relative mt-4 col-span-2">
                            <input type="text" name="name" readonly
                                value="{{ $booking->user->first_name }} {{ $booking->user->last_name }}"
                                class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.name') }}
                            </label>
                        </div>

                        <!-- EMAIL -->
                        <div class="relative mt-2">
                            <input type="email" readonly name="email" value="{{ $booking->user->email }}"
                                class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.email') }}
                            </label>
                        </div>

                        <!-- PHONE NUMBER -->
                        <div class="relative mt-2">
                            <input type="text" name="phone" readonly value="{{ $booking->user->phone }}"
                                class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                            <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                {{ __('admin.phone_number') }}
                            </label>
                        </div>

                    </div>
                </div>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">{{ __('admin.payment') }}</h2>
                <!-- TOTAL PRICE -->
                <div class="relative mt-2 col-span-2">
                    <input type="text" readonly name="total"
                        value="Rp {{ number_format($booking->total_price, 0, ',', '.') }}"
                        class="bg-softGrey w-full border border-darkGreen rounded-md px-3 text-sm h-12 flex items-center focus:outline-none" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.total_price') }}
                    </label>
                </div>

                <!-- Payment Proof -->
                <div class="mt-2">
                    <p class="text-sm text-darkGrey mb-3">
                        {{ __('admin.payment_proof') }}
                    </p>
                    <label
                        class="flex items-center justify-center w-full
                   border border-dashed border-darkGreen
                   rounded-xl h-40 cursor-pointer
                   text-sm text-mediumGrey">
                        @if ($booking->payment_proof)
                            <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                                class="w-full h-full object-cover cursor-zoom-in" onclick="window.open(this.src)">
                        @else
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-image text-xl"></i>
                                {{ __('admin.no_payment_proof') }}
                            </div>
                        @endif
                    </label>
                </div>

                <hr class="border-2 border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">{{ __('admin.booking_status') }}</h2>
                <!-- STATUS -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <select name="status"
                            class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey"
                            required>

                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                {{ __('admin.pending') }}
                            </option>

                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                {{ __('admin.confirmed') }}
                            </option>

                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>
                                {{ __('admin.completed') }}
                            </option>

                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                {{ __('admin.cancelled') }}
                            </option>

                        </select>

                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>

                        <label
                            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                            {{ __('admin.status') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- SUBMIT -->
            <div class="flex gap-4">

                <!-- SAVE -->
                <button type="submit"
                    class="bg-darkGreen text-white text-sm font-medium
               px-12 md:px-16 py-3 rounded-lg
               hover:bg-darkGreen/90 transition">
                     {{ __('admin.save') }}
                </button>

        </form>

        <!-- DELETE -->
        <form id="deleteBooking" action="{{ route('bookings.destroy', $booking) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="button" onclick="confirmDelete('deleteBooking', ' {{ __('admin.delete_booking') }}?')"
                class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                 {{ __('admin.delete_booking') }}
            </button>
        </form>

        </div>

    </section>
@endsection
