@extends('layout.admin')

@section('title', 'Add New Customer')

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('customers.index') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            Account Setting
        </h1>

        <!-- FORM -->
        <form class="space-y-12">

            <div class="flex justify-center">
                <label class="relative cursor-pointer">
                    <input type="file" class="hidden">

                    <!-- Avatar -->
                    <div
                        class="w-36 h-36 rounded-full bg-mediumGrey/80
                    flex items-center justify-center">
                        <i class="fa-regular fa-user text-6xl text-white"></i>
                    </div>

                    <!-- Edit Icon -->
                    <div
                        class="absolute bottom-2 right-2
                   w-9 h-9 rounded-full bg-darkGreen
                   flex items-center justify-center
                   text-white shadow-md">
                        <i class="fa-solid fa-pen text-sm"></i>
                    </div>
                </label>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="font-semibold text-base text-darkGrey mb-8">
                    Personal Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div class="relative">
                        <input type="text"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            First Name
                        </label>
                    </div>

                    <!-- Last Name -->
                    <div class="relative">
                        <input type="text"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            Last Name
                        </label>
                    </div>

                    <!-- Phone -->
                    <div class="relative col-span-2">
                        <input type="text"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            Phone Number
                        </label>
                    </div>

                    <!-- Date -->
                    <div class="relative">
                        <input type="date"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            Date of Birth (Optional)
                        </label>
                    </div>

                    <!-- Country -->
                    <div class="relative">
                        <select
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                            <option hidden></option>
                            <option>Indonesia</option>
                        </select>
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            Country (Optional)
                        </label>
                    </div>
                </div>

                <button class="mt-8 bg-darkGreen text-white px-16 py-3 rounded-lg text-sm font-medium">
                    Update
                </button>
            </div>

            <!-- Security -->
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="font-semibold text-base text-darkGrey mb-8">
                    Security
                </h2>

                <div class="space-y-6">

                    <!-- Email -->
                    <div class="relative">
                        <input type="email"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            Email
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input type="password" id="password"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            Password
                        </label>

                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
                            onclick="togglePassword()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                
                <button class="mt-8 bg-darkGreen text-white px-16 py-3 rounded-lg text-sm font-medium">
                    Change
                </button>
            </div>

        </form>

    </section>
@endsection

@push('scripts')
    <script>
        //Toggle Password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endpush
