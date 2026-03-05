@extends('layout.admin')

@section('title', __('admin.edit_category'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.category.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.edit_category') }}
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
        <form method="POST" action="{{ route('package.category.update', $category) }}" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name ID -->
                <div class="relative mt-4">
                    <input type="text" name="name_id" placeholder="{{ __('admin.enter_indonesian_name') }}"
                    value="{{ old('name_id', $category->name_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (ID)
                    </label>
                </div>

                <!-- Name EN -->
                <div class="relative mt-4">
                    <input type="text" name="name_en" placeholder="{{ __('admin.enter_english_name') }}"
                    value="{{ old('name_en', $category->name_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        {{ __('admin.name') }} (EN)
                    </label>
                </div>

                <!-- Description ID -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="description_id" placeholder="{{ __('admin.enter_indonesian_description') }}"
                        value="{{ old('description_id', $category->description_id) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description') }} (ID)
                        </label>
                    </div>
                </div>

                <!-- Description EN -->
                <div class="md:col-span-2">
                    <div class="relative mt-2">
                        <input type="text" name="description_en" placeholder="{{ __('admin.enter_english_description') }}"
                        value="{{ old('description_en', $category->description_en) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            {{ __('admin.description') }} (EN)
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
        <form id="deleteCategory" action="{{ route('package.category.destroy', $category) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="button" onclick="confirmDelete('deleteCategory', '{{ __('admin.delete_category') }}?')"
                class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                {{ __('admin.delete_category') }}
            </button>
        </form>

        </div>

    </section>
@endsection
