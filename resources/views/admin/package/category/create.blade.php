@extends('layout.admin')

@section('title', 'Add New Category')

@section('content')
    <section class="w-full">

    <!-- BACK -->
    <a href="{{ route('package.category.index') }}"
       class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>

    <!-- TITLE -->
    <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
        Add New Category
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
    <form action="{{ route('package.category.store') }}" method="POST" class="space-y-10">
            @csrf

        <!-- INPUTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Name ID -->
            <div class="relative mt-4">
                    <input type="text" name="name_id" placeholder="Enter the indonesian name"
                    value="{{ old('name_id', $category->name_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Name (ID)
                    </label>
                </div>

            <!-- Name EN -->
            <div class="relative mt-4">
                    <input type="text" name="name_en" placeholder="Enter the english name"
                    value="{{ old('name_en', $category->name_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Name (EN)
                    </label>
                </div>

            <!-- Description ID -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="description_id" placeholder="Enter the indonesian description"
                    value="{{ old('description_id', $category->description_id) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (ID)
                    </label>
                </div>
            </div>

            <!-- Description EN -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <input type="text" name="description_en" placeholder="Enter the english description"
                    value="{{ old('description_en', $category->description_en) }}"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Description (EN)
                    </label>
                </div>
            </div>
        </div>

        <!-- SUBMIT -->
        <button
            class="bg-darkGreen text-white text-sm font-medium
                   px-12 py-3 rounded-lg w-1/2 lg:w-1/3
                   hover:bg-darkGreen/90 transition">
            Add New
        </button>

    </form>

    </section>
@endsection