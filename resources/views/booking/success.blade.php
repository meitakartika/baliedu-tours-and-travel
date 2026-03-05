@extends('layout.authentication')

@section('content')
<section class="min-h-screen flex items-center justify-center px-6">

    <div class="text-center max-w-md">

        <!-- ICON -->
        <div class="mx-auto mb-6 w-20 h-20 rounded-full bg-darkGreen flex items-center justify-center">
            <i class="fa-solid fa-check text-white text-5xl"></i>
        </div>

        <!-- TITLE -->
        <h1 class="text-2xl font-semibold text-darkGrey mb-3">
            {{ __('booking.order_complete_title') }}
        </h1>

        <!-- DESCRIPTION -->
        <p class="text-mediumGrey text-sm leading-relaxed mb-8">
            {{ __('booking.order_complete_desc') }}
        </p>

        <!-- BUTTON -->
        <a href="{{ route('home') }}"
           class="inline-flex items-center justify-center px-6 py-3
                  border border-darkGreen text-darkGreen
                  rounded-md font-medium text-sm
                  hover:bg-darkGreen hover:text-white transition">
            {{ __('booking.go_home') }}
        </a>

    </div>

</section>
@endsection
