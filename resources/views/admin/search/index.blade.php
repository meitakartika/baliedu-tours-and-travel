@extends('layout.admin')

@section('title', __('admin.search_result'))

@section('content')

<h2 class="text-xl font-semibold text-darkGrey mb-8">
    {{ __('admin.result_for') }} "{{ $search }}"
</h2>

{{-- ================= BOOKING ================= --}}
@if($bookings->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.bookings') }} ({{ $bookings->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($bookings as $booking)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $booking->user->first_name ?? '' }}
                {{ $booking->user->last_name ?? '' }}
                -
                {{ $booking->package->name_en ?? '' }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= PACKAGES ================= --}}
@if($packages->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.packages') }} ({{ $packages->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($packages as $package)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $package->name_en }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= CUSTOMERS ================= --}}
@if($customers->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.customers') }} ({{ $customers->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($customers as $customer)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $customer->first_name }}
                {{ $customer->last_name }}
                -
                {{ $customer->email }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= CATEGORIES ================= --}}
@if($categories->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.categories') }} ({{ $categories->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($categories as $category)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $category->name_en }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= TYPES ================= --}}
@if($types->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.types') }} ({{ $types->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($types as $type)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $type->name_en }}
                ({{ __('admin.category') }}: {{ $type->category->name_en ?? '-' }})
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= ITINERARY (PACKAGE BASED) ================= --}}
@if($itineraries->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.itineraries') }} ({{ $itineraries->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($itineraries as $package)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $package->name_en }}
                ({{ $package->itineraries_count }} {{ __('admin.itineraries') }})
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= LIST (PACKAGE BASED) ================= --}}
@if($lists->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.lists') }} ({{ $lists->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($lists as $package)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $package->name_en }}
                | {{ __('admin.includes') }}: {{ $package->includes_count }}
                | {{ __('admin.not_includes') }}: {{ $package->not_includes_count }}
                | {{ __('admin.must_bring') }}: {{ $package->must_bring_count }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= TESTIMONIALS ================= --}}
@if($testimonials->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.testimonials') }} ({{ $testimonials->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($testimonials as $testimonial)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $testimonial->user->first_name ?? '' }}
                {{ $testimonial->user->last_name ?? '' }}
                -
                {{ $testimonial->package->name_en ?? '' }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= CONTACT INFO ================= --}}
@if($contactInfos->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.contact_info') }} ({{ $contactInfos->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($contactInfos as $info)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $info->type }} -
                {{ $info->label }} :
                {{ $info->value_en }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= CONTACT MESSAGE ================= --}}
@if($contactMessages->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        {{ __('admin.contact_messages') }} ({{ $contactMessages->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($contactMessages as $message)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $message->user->first_name ?? '' }}
                {{ $message->user->last_name ?? '' }}
                -
                {{ $message->created_at->format('d M Y') }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= NO RESULT ================= --}}
@if(
    !$bookings->count() &&
    !$packages->count() &&
    !$customers->count() &&
    !$categories->count() &&
    !$contactInfos->count() &&
    !$contactMessages->count() &&
    !$itineraries->count() &&
    !$lists->count() &&
    !$testimonials->count() &&
    !$types->count()
)
<div class="bg-white p-6 rounded-lg shadow-sm text-center text-mediumGrey">
    {{ __('admin.no_result') }}
</div>
@endif

@endsection