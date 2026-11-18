
@extends('layout.admin')

@section('title', 'FAQ Section')

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
            FAQ Section
        </h1>

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
            <div class="rounded-lg bg-green/5 border border-green-600 p-4 text-green-700 text-sm mb-6">
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
        <form action="{{ route('page.faq.update') }}" method="POST" class="space-y-10">

            @csrf
            @method('PUT')

            <!-- HEADING CONTENT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <h2 class="font-semibold text-base text-darkGrey col-span-2">
                    Heading Content
                </h2>

                <!-- LABEL ID -->
                <div class="relative mt-2">
                    <input type="text" name="label_id"
                        value="{{ old('label_id', $faqSection->label_id) }}"
                        placeholder="Enter Indonesian label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (ID)
                    </label>
                </div>

                <!-- LABEL EN -->
                <div class="relative mt-2">
                    <input type="text" name="label_en"
                        value="{{ old('label_en', $faqSection->label_en) }}"
                        placeholder="Enter English label"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Label (EN)
                    </label>
                </div>

                <!-- TITLE ID -->
                <div class="relative mt-2">
                    <input type="text" name="title_id"
                        value="{{ old('title_id', $faqSection->title_id) }}"
                        placeholder="Enter Indonesian title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (ID)
                    </label>
                </div>

                <!-- TITLE EN -->
                <div class="relative mt-2">
                    <input type="text" name="title_en"
                        value="{{ old('title_en', $faqSection->title_en) }}"
                        placeholder="Enter English title"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Title (EN)
                    </label>
                </div>

            </div>

            <!-- FAQ ITEMS -->
            @for ($i = 1; $i <= 6; $i++)

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <hr class="border-darkGreen mt-3 col-span-2">

                    <h2 class="font-semibold text-base text-darkGrey mt-3 col-span-2">
                        FAQ Item {{ $i }}
                    </h2>

                    <!-- QUESTION ID -->
                    <div class="relative mt-2">
                        <input type="text"
                            name="question_{{ $i }}_id"
                            value="{{ old('question_' . $i . '_id', $faqSection->{'question_' . $i . '_id'}) }}"
                            placeholder="Enter question (ID)"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Question (ID)
                        </label>
                    </div>

                    <!-- QUESTION EN -->
                    <div class="relative mt-2">
                        <input type="text"
                            name="question_{{ $i }}_en"
                            value="{{ old('question_' . $i . '_en', $faqSection->{'question_' . $i . '_en'}) }}"
                            placeholder="Enter question (EN)"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 h-12 text-sm focus:outline-none focus:border-darkGreen">

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Question (EN)
                        </label>
                    </div>

                    <!-- ANSWER ID -->
                    <div class="relative mt-2">
                        <textarea name="answer_{{ $i }}_id" rows="5"
                            placeholder="Enter answer (ID)"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen">{{ old('answer_' . $i . '_id', $faqSection->{'answer_' . $i . '_id'}) }}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Answer (ID)
                        </label>
                    </div>

                    <!-- ANSWER EN -->
                    <div class="relative mt-2">
                        <textarea name="answer_{{ $i }}_en" rows="5"
                            placeholder="Enter answer (EN)"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 py-3 text-sm resize-y focus:outline-none focus:border-darkGreen">{{ old('answer_' . $i . '_en', $faqSection->{'answer_' . $i . '_en'}) }}</textarea>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Answer (EN)
                        </label>
                    </div>

                </div>

            @endfor

            <!-- SUBMIT -->
            <button type="submit"
                class="bg-darkGreen text-white text-sm font-medium px-12 py-3 rounded-lg w-1/2 lg:w-1/3 hover:bg-darkGreen/90 transition">
                {{ __('admin.save') }}
            </button>

        </form>

    </section>
@endsection
