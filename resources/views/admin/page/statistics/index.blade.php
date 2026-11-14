@extends('layout.admin')

@section('title', 'Statistics Section')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('page.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Statistics Section
        </h1>

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
            <div class="rounded-lg bg-green-50 border border-green-500 p-4 text-green-700 text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERROR VALIDATION -->
        @if ($errors->any())
            <div class="rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm mb-6">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('page.statistics.update') }}" method="POST" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- HEADING CONTENT -->
            <div>
                <h2 class="text-darkGrey font-semibold mb-5">
                    Heading Content
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Label ID -->
                    <div class="relative mt-4">
                        <input type="text" name="label_id" value="{{ old('label_id', $statisticsSection->label_id) }}"
                            placeholder="Enter label"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                            required>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Label (ID)
                        </label>
                    </div>

                    <!-- Label EN -->
                    <div class="relative mt-4">
                        <input type="text" name="label_en" value="{{ old('label_en', $statisticsSection->label_en) }}"
                            placeholder="Enter label"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                            required>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Label (EN)
                        </label>
                    </div>

                    <!-- Title ID -->
                    <div class="relative mt-2">
                        <input type="text" name="title_id" value="{{ old('title_id', $statisticsSection->title_id) }}"
                            placeholder="Enter title"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                            required>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Title (ID)
                        </label>
                    </div>

                    <!-- Title EN -->
                    <div class="relative mt-2">
                        <input type="text" name="title_en" value="{{ old('title_en', $statisticsSection->title_en) }}"
                            placeholder="Enter title"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                            required>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Title (EN)
                        </label>
                    </div>

                    <!-- Description ID -->
                    <div class="relative mt-2">
                        <textarea name="description_id" rows="5" placeholder="Enter description"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                            required>{{ old('description_id', $statisticsSection->description_id) }}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Description (ID)
                        </label>
                    </div>

                    <!-- Description EN -->
                    <div class="relative mt-2">
                        <textarea name="description_en" rows="5" placeholder="Enter description"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen"
                            required>{{ old('description_en', $statisticsSection->description_en) }}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Description (EN)
                        </label>
                    </div>

                </div>
            </div>


            <!-- STATISTICS 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <hr class="border-darkGreen mt-3 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                    Statistics 1
                </h2>

                <!-- Number 1 -->
                <div class="relative mt-2 col-span-2">
                    <input type="text" name="number_1" value="{{ old('number_1', $statisticsSection->number_1) }}"
                        placeholder="Enter number"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Number
                    </label>
                </div>

                <!-- Text 1 ID -->
                <div class="relative mt-2">
                    <input type="text" name="text_1_id" value="{{ old('text_1_id', $statisticsSection->text_1_id) }}"
                        placeholder="Enter description (ID)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Text (ID)
                    </label>
                </div>

                <!-- Text 1 EN -->
                <div class="relative mt-2">
                    <input type="text" name="text_1_en" value="{{ old('text_1_en', $statisticsSection->text_1_en) }}"
                        placeholder="Enter description (EN)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Text (EN)
                    </label>
                </div>

            </div>

            <!-- STATISTICS 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <hr class="border-darkGreen mt-3 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                    Statistics 2
                </h2>

                <!-- Number 2 -->
                <div class="relative mt-2 col-span-2">
                    <input type="text" name="number_2" value="{{ old('number_2', $statisticsSection->number_2) }}"
                        placeholder="Enter number"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Number
                    </label>
                </div>

                <!-- Text 2 ID -->
                <div class="relative mt-2">
                    <input type="text" name="text_2_id" value="{{ old('text_2_id', $statisticsSection->text_2_id) }}"
                        placeholder="Enter description (ID)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Text (ID)
                    </label>
                </div>

                <!-- Text 2 EN -->
                <div class="relative mt-2">
                    <input type="text" name="text_2_en" value="{{ old('text_2_en', $statisticsSection->text_2_en) }}"
                        placeholder="Enter description (EN)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Text (EN)
                    </label>
                </div>

            </div>

            <!-- STATISTICS 3 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <hr class="border-darkGreen mt-3 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                    Statistics 3
                </h2>

                <!-- Number 3 -->
                <div class="relative mt-2 col-span-2">
                    <input type="text" name="number_3" value="{{ old('number_3', $statisticsSection->number_3) }}"
                        placeholder="Enter number"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Number
                    </label>
                </div>

                <!-- Text 3 ID -->
                <div class="relative mt-2">
                    <input type="text" name="text_3_id" value="{{ old('text_3_id', $statisticsSection->text_3_id) }}"
                        placeholder="Enter description (ID)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Text (ID)
                    </label>
                </div>

                <!-- Text 3 EN -->
                <div class="relative mt-2">
                    <input type="text" name="text_3_en" value="{{ old('text_3_en', $statisticsSection->text_3_en) }}"
                        placeholder="Enter description (EN)"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen"
                        required>

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Text (EN)
                    </label>
                </div>

            </div>

            <!-- SUBMIT -->
            <button type="submit"
                class="bg-darkGreen text-white text-sm font-medium px-12 py-3 rounded-lg w-1/2 lg:w-1/3 hover:bg-darkGreen/90 transition">
                {{ __('admin.save') }}
            </button>

        </form>

    </section>
@endsection
