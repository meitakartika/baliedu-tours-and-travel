@extends('layout.admin')

@section('title', 'Add New List')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('package.list.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Add New List
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
        <form action="{{ route('package.list.store') }}" method="POST" class="space-y-10">
            @csrf

            <!-- INPUTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <h2 class="font-semibold text-base text-darkGrey mt-4">Tour Package</h2>
                <div class="col-span-2">
                    <div class="relative mt-1">
                        <select name="package_id"
                            class="peer appearance-none bg-white w-full border border-mediumGrey rounded-md
           px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
           text-darkGrey"
                            required>

                            <option value="" disabled selected hidden>
                                Select the tour package
                            </option>

                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}"
                                    {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'id' ? $package->name_id : $package->name_en }}
                                </option>
                            @endforeach

                        </select>

                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>

                        <label
                            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white
               peer-focus:text-darkGreen">
                            Tour Package
                        </label>
                    </div>
                </div>

                <hr class="border-2 border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Includes List</h2>

                @php
                    $includes = old('list.includes', [[]]);
                @endphp

                <div id="includes-wrapper" class="col-span-2 space-y-4">

                    @foreach ($includes as $i => $include)
                        <div class="grid grid-cols-2 gap-4 item relative">

                            <button type="button" onclick="removeItem(this)"
                                class="absolute -top-2 -right-2 bg-red text-white z-20
               w-6 h-6 rounded-full text-xs hover:bg-red/80">
                                ✕
                            </button>

                            <div class="relative mt-2">
                                <textarea name="list[includes][{{ $i }}][content_id]" rows="4"
                                    placeholder="Enter the indonesian content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen">{{ $include['content_id'] ?? '' }}</textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (ID)
                                </label>
                            </div>

                            <div class="relative mt-2">
                                <textarea name="list[includes][{{ $i }}][content_en]" rows="4" placeholder="Enter the english content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen">{{ $include['content_en'] ?? '' }}</textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (EN)
                                </label>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- ADD MORE CONTENT -->
                <button type="button" onclick="addItem('includes-wrapper','includes')"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Content
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Not Includes List</h2>

                @php
                    $notIncludes = old('list.not_includes', [[]]);
                @endphp

                <div id="notIncludes-wrapper" class="col-span-2 space-y-4">

                    @foreach ($notIncludes as $i => $notInclude)
                        <div class="grid grid-cols-2 gap-4 item relative">

                            <button type="button" onclick="removeItem(this)"
                                class="absolute -top-2 -right-2 bg-red text-white z-20
               w-6 h-6 rounded-full text-xs hover:bg-red/80">
                                ✕
                            </button>

                            <div class="relative mt-2">
                                <textarea name="list[not_includes][{{ $i }}][content_id]" rows="4"
                                    placeholder="Enter the indonesian content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen">{{ $notInclude['content_id'] ?? '' }}</textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (ID)
                                </label>
                            </div>

                            <div class="relative mt-2">
                                <textarea name="list[not_includes][{{ $i }}][content_en]" rows="4"
                                    placeholder="Enter the english content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen">{{ $notInclude['content_en'] ?? '' }}</textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (EN)
                                </label>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- ADD MORE CONTENT -->
                <button type="button" onclick="addItem('notIncludes-wrapper','not_includes')"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Content
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">

                <h2 class="font-semibold text-base text-darkGrey mt-4 col-span-2">Must Bring List</h2>

                @php
                    $mustBring = old('list.must_bring', [[]]);
                @endphp

                <div id="mustBring-wrapper" class="col-span-2 space-y-4">

                    @foreach ($mustBring as $i => $bring)
                        <div class="grid grid-cols-2 gap-4 item relative">

                            <button type="button" onclick="removeItem(this)"
                                class="absolute -top-2 -right-2 bg-red text-white z-20
               w-6 h-6 rounded-full text-xs hover:bg-red/80">
                                ✕
                            </button>
                            
                            <div class="relative mt-2">
                                <textarea name="list[must_bring][{{ $i }}][content_id]" rows="4"
                                    placeholder="Enter the indonesian content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen">{{ $bring['content_id'] ?? '' }}</textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (ID)
                                </label>
                            </div>

                            <div class="relative mt-2">
                                <textarea name="list[must_bring][{{ $i }}][content_en]" rows="4"
                                    placeholder="Enter the english content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen">{{ $bring['content_en'] ?? '' }}</textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (EN)
                                </label>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- ADD MORE CONTENT -->
                <button type="button" onclick="addItem('mustBring-wrapper','must_bring')"
                    class="flex items-center gap-2 text-sm font-medium text-darkGreen hover:text-darkGreen/80">
                    <i class="fa-solid fa-plus"></i>
                    Add More Content
                </button>

                <hr class="border-darkGreen mt-4 col-span-2">
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

@push('scripts')
    <script>
        function addItem(wrapperId, type) {

            const wrapper = document.getElementById(wrapperId);
            const index = wrapper.querySelectorAll('.item').length;

            const html = `
        <div class="grid grid-cols-2 gap-4 item relative">

            <button type="button"
                onclick="removeItem(this)"
                class="absolute -top-2 -right-2 bg-red text-white z-20
                w-6 h-6 rounded-full text-xs hover:bg-red/80">
                ✕
            </button>

            <div class="relative mt-2">
                                <textarea name="list[${type}][${index}][content_id]" rows="4"
                                    placeholder="Enter the indonesian content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen"></textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (ID)
                                </label>
                            </div>

                            <div class="relative mt-2">
                                <textarea name="list[${type}][${index}][content_en]" rows="4" placeholder="Enter the english content"
                                    class="bg-softGrey w-full border rounded-md px-3 py-3 text-sm resize-none
        focus:outline-none focus:border-darkGreen"></textarea>
                                <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                                    Content (EN)
                                </label>
                            </div>

        </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        }

        function removeItem(button) {

            const item = button.closest('.item');
            const wrapper = item.parentElement;

            item.remove();

            reIndex(wrapper);
        }

        function reIndex(wrapper) {

            const items = wrapper.querySelectorAll('.item');

            items.forEach((item, index) => {

                const textareas = item.querySelectorAll('textarea');

                textareas.forEach(textarea => {
                    textarea.name = textarea.name.replace(/\[\d+\]/, `[${index}]`);
                });
            });
        }
    </script>
@endpush
