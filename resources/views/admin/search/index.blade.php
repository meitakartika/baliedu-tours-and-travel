@extends('layout.admin')

@section('title', 'Search Result')

@section('content')

<h2 class="text-xl font-semibold text-darkGrey mb-8">
    Search Result for "{{ $search }}"
</h2>

{{-- ================= BOOKING ================= --}}
@if($bookings->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        Bookings ({{ $bookings->count() }})
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
        Packages ({{ $packages->count() }})
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
        Customers ({{ $customers->count() }})
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
        Categories ({{ $categories->count() }})
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
        Types ({{ $types->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($types as $type)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $type->name_en }}
                (Category: {{ $type->category->name_en ?? '-' }})
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= ITINERARY (PACKAGE BASED) ================= --}}
@if($itineraries->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        Itineraries ({{ $itineraries->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($itineraries as $package)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $package->name_en }}
                ({{ $package->itineraries_count }} itineraries)
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= LIST (PACKAGE BASED) ================= --}}
@if($lists->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        Lists ({{ $lists->count() }})
    </h3>
    <ul class="space-y-2">
        @foreach($lists as $package)
            <li class="bg-white p-4 rounded-lg shadow-sm text-sm">
                {{ $package->name_en }}
                | Includes: {{ $package->includes_count }}
                | Not Includes: {{ $package->not_includes_count }}
                | Must Bring: {{ $package->must_bring_count }}
            </li>
        @endforeach
    </ul>
</div>
@endif


{{-- ================= TESTIMONIALS ================= --}}
@if($testimonials->count())
<div class="mb-10">
    <h3 class="font-semibold text-darkGrey text-md mb-3">
        Testimonials ({{ $testimonials->count() }})
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
        Contact Info ({{ $contactInfos->count() }})
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
        Contact Messages ({{ $contactMessages->count() }})
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
    No result found.
</div>
@endif

@endsection