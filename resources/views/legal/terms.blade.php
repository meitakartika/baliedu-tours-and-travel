@extends('layout.authentication')

@section('title', __('legal.terms_title'))

@section('content')

<div class="max-w-4xl mx-auto py-16 px-6">

    <h1 class="text-3xl font-semibold mb-6 text-darkGreen">
        {{ __('legal.terms_title') }}
    </h1>

    <p class="mb-4">
        {{ __('legal.terms_intro') }}
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ __('legal.bookings_title') }}
    </h2>

    <p class="mb-4">
        {{ __('legal.bookings_desc') }}
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ __('legal.payments_title') }}
    </h2>

    <p class="mb-4">
        {{ __('legal.payments_desc') }}
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ __('legal.cancellation_title') }}
    </h2>

    <p class="mb-4">
        {{ __('legal.cancellation_desc') }}
    </p>

</div>

@endsection