@extends('layout.admin')

@section('title', __('admin.add_new_contact'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('contact.info.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.add_new_contact') }}
        </h1>

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
            <div class="rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('contact.info.store') }}" class="space-y-10">
            @csrf

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Type -->
                <div class="relative mt-4">
                    <select name="type"
                        class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey"
                        required>

                        <option value="" disabled selected hidden>
                            {{ __('admin.select_contact_type') }}
                        </option>

                        @foreach ($types as $key => $label)
                            <option value="{{ $key }}" {{ old('type', $contactInfo->type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach

                    </select>

                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </span>

                    <label
                        class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                        {{ __('admin.type') }}
                    </label>
                </div>

                <!-- Label -->
                <div class="relative mt-4">
                    <input type="text" name="label" placeholder="{{ __('admin.enter_contact_label') }}" value="{{ old('label', $contactInfo->label) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.label') }} (Optional)
                    </label>
                </div>

            </div>

            <!-- Value ID -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="value_id" placeholder="{{ __('admin.enter_indonesian_value') }}"
                        value="{{ old('value_id', $contactInfo->value_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.value_id') }}
                    </label>
                </div>
            </div>

            <!-- Value EN -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="value_en" placeholder="{{ __('admin.enter_english_value') }}"
                        value="{{ old('value_en', $contactInfo->value_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.value_en') }}
                    </label>
                </div>
            </div>

            <!-- SUBMIT -->
            <button
                class="bg-darkGreen text-white text-sm font-medium
                   px-12 py-3 rounded-lg w-1/2 lg:w-1/3
                   hover:bg-darkGreen/90 transition">
                {{ __('admin.add_new') }}
            </button>

        </form>

    </section>
@endsection
