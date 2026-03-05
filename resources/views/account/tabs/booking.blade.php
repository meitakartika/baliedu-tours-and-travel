<h2 class="text-lg font-semibold mb-7">{{ __('account.my_booking') }}</h2>

@if($bookings->isEmpty())
<div class="col-span-12 flex flex-col items-center justify-center py-20 text-center">
        <img src="{{ asset('images/empty.png') }}" alt="Empty Booking" class="w-48 mb-8">
        <h3 class="text-lg font-semibold text-darkGrey mb-2">
            {{ __('account.empty_booking_title') }}
        </h3>
        <p class="text-sm text-mediumGrey max-w-md">
            {{ __('account.empty_booking_desc') }}
        </p>
    </div>
@else

<!-- TABLE HEADER -->
<div class="hidden md:grid grid-cols-12 text-sm text-mediumGrey font-medium pb-4 border-b border-mediumGrey/20">
    <div class="col-span-4">{{ __('account.tour_name') }}</div>
    <div class="col-span-3 text-center">{{ __('account.price') }}</div>
    <div class="col-span-3 text-center">{{ __('account.payment') }}</div>
    <div class="col-span-2 text-center">{{ __('account.status') }}</div>
</div>

@foreach ($bookings as $booking)
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-0
           py-6 {{ !$loop->last ? 'border-b' : '' }}">

    <!-- TOUR INFO -->
    <div class="md:col-span-4 flex items-center gap-4">
        <img src="{{ asset('storage/'.$booking->package->image_url) }}"
             class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover"
             alt="{{ app()->getLocale() === 'id' ? $booking->package->name_id : $booking->package->name_en }}">

        <div>
            <h3 class="font-semibold text-darkGrey text-sm">{{ app()->getLocale() === 'id' ? $booking->package->name_id : $booking->package->name_en }}</h3>

            <div class="flex items-center gap-2 text-sm text-darkGreen mt-1">
                <i class="fa-regular fa-calendar"></i>
                <span>{{ app()->getLocale() === 'id' ? $booking->tour_date->format('d M Y') : $booking->tour_date->translatedFormat('d M Y') }}</span>
            </div>

            <div class="flex items-center gap-2 text-sm text-darkGreen mt-1">
                <i class="fa-solid fa-user-group"></i>
                <span>{{ $booking->guest_count }} {{ __('account.guests') }}</span>
            </div>
        </div>
    </div>

    <!-- PRICE -->
    <div class="md:col-span-3 md:flex md:items-center md:justify-center 
                text-sm font-semibold text-darkGrey text-left md:text-center mt-1 md:mt-0">
        Rp{{ number_format($booking->package->price * $booking->guest_count, 0, ',', '.') }}
    </div>

    <!-- PAYMENT -->
    <div class="md:col-span-3 md:flex md:items-center md:justify-center text-sm mt-1 md:mt-0">
        <a href="{{ asset('storage/' . $booking->payment_proof) }}"
           target="_blank"
           class="text-darkGreen font-medium hover:underline flex items-center gap-2">
            <i class="fa-regular fa-file-lines"></i>
            {{ __('account.view_proof') }}
        </a>
    </div>

    <!-- STATUS -->
    <div class="md:col-span-2 md:flex md:items-center md:justify-center
                text-left md:text-center mt-1 md:mt-0">
        
        @if($booking->status === 'pending')
        <span
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                   bg-red/10 text-red/80 text-sm font-medium">
            <i class="fa-solid fa-clock"></i>
            {{ __('account.verification') }}
        </span>

        @elseif($booking->status === 'confirmed')
        <span
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                   bg-paleGreen/40 text-darkGreen text-sm font-medium">
            <i class="fa-solid fa-check"></i>
            {{ __('account.confirmed') }}
        </span>

        @elseif($booking->status === 'completed')
        <span
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                   bg-paleGreen/40 text-darkGreen text-sm font-medium">
            <i class="fa-solid fa-circle-check"></i>
            {{ __('account.completed') }}
        </span>
        @endif

    </div>
</div>
@endforeach
@endif
