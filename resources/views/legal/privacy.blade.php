@extends('layout.authentication')

@section('title', __('legal.privacy_title'))

@section('content')

<div class="max-w-4xl mx-auto py-16 px-6">
    <h1 class="text-3xl font-semibold mb-6 text-darkGreen">
        {{ __('legal.privacy_title') }}
    </h1>

    <p class="mb-4">
        {{ __('legal.privacy_intro') }}
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ __('legal.info_collect_title') }}
    </h2>

    <p class="mb-4">
        {{ __('legal.info_collect_desc') }}
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ __('legal.info_use_title') }}
    </h2>

    <p class="mb-4">
        {{ __('legal.info_use_desc') }}
    </p>

</div>

@endsection