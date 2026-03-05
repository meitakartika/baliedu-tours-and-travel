@extends('layout.admin')

@section('title', __('admin.edit_type'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.type.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.edit_type') }}
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
        <form method="POST" action="{{ route('package.type.update', $type) }}" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <div class="md:col-span-2">
                    <div class="relative mt-4">
                        <select name="category_id"
                            class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey"
                            required>

                            <option value="" disabled selected hidden>
                                {{ __('admin.select_category') }}
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $type->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}
                                </option>
                            @endforeach

                        </select>

                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>

                        <label
                            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                            {{ __('admin.category') }}
                        </label>
                    </div>
                </div>

                <!-- Name ID -->
                <div class="relative mt-2">
                    <input type="text" name="name_id" placeholder="{{ __('admin.enter_indonesian_name') }}"
                        value="{{ old('name_id', $type->name_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (ID)
                    </label>
                </div>

                <!-- Name EN -->
                <div class="relative mt-2">
                    <input type="text" name="name_en" placeholder="{{ __('admin.enter_english_name') }}"
                        value="{{ old('name_en', $type->name_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (EN)
                    </label>
                </div>

                <!-- Description ID -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="description_id" placeholder="{{ __('admin.enter_indonesian_description') }}"
                            value="{{ old('description_id', $type->description_id) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description_id') }}
                        </label>
                    </div>
                </div>

                <!-- Description EN -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="description_en" placeholder="{{ __('admin.enter_english_description') }}"
                            value="{{ old('description_en', $type->description_en) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description_en') }}
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
        <form id="deleteType" action="{{ route('package.type.destroy', $type) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete('deleteType', '{{ __('admin.delete_type') }}?')"
                class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                {{ __('admin.delete_type') }}
            </button>
        </form>

        </div>

    </section>
@endsection
