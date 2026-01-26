@extends('layout.admin')

@section('title', 'Edit Customer')

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
        Edit User
    </h1>

    <!-- FORM -->
    <form class="space-y-10">

        <!-- AVATAR -->
        <div class="flex justify-center">
            <label class="relative cursor-pointer">
                <input type="file" class="hidden">
                <div
                    class="w-36 h-36 rounded-full bg-mediumGrey/10
                           flex items-center justify-center">
                    <i class="fa-regular fa-image text-3xl text-darkGrey"></i>
                </div>
            </label>
        </div>

        <!-- INPUTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- First Name -->
            <div class="relative mt-4">
                    <input type="text" name="name" placeholder="Enter your first name"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        First Name
                    </label>
                </div>

            <!-- Last Name -->
            <div class="relative mt-4">
                    <input type="text" name="name" placeholder="Enter your last name"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Last Name
                    </label>
                </div>

            <!-- Email -->
            <div class="relative mt-2">
                    <input type="email" name="email" placeholder="Enter your email"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Email
                    </label>
                </div>

            <!-- Phone -->
            <div class="relative mt-2">
                    <input type="text" name="phone" placeholder="Enter your phone number"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Phone Number
                    </label>
                </div>

            <!-- Date -->
            <div class="relative mt-2">
        <input type="date" name="birth"
            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center
                   focus:outline-none focus:border-darkGreen" />
        <label
            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
            Date of Birth (Optional)
        </label>
    </div>

            <!-- Country -->
            <div class="relative mt-2">
                    <select name="country"
                        class="peer bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
               text-darkGrey"
                        required>
                        <option value="" disabled selected hidden></option>
                        <option value="id">Indonesia</option>
                        <option value="au">Australia</option>
                        <option value="us">United States</option>
                    </select>

                    <label
                        class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                        Country (Optional)
                    </label>
                </div>

            <!-- Password -->
            <div class="relative mt-2">
                    <input type="password" name="password" placeholder="Enter your password" id="password"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Password
                    </label>
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
                            onclick="togglePassword()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                </div>

            <!-- Confirm -->
            <div class="relative mt-2">
                    <input type="password" name="password_confirmation" placeholder="Confirm your password" id="confirmPassword"
                        class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                    <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                        Confirm Password
                    </label>
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
                            onclick="toggleConfirmPassword()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                </div>

            <!-- Role -->
            <div class="md:col-span-2">
                <div class="relative mt-2">
                    <select name="role"
                        class="peer bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
               text-darkGrey"
                        required>
                        <option value="" disabled selected hidden></option>
                        <option value="adm">Admin</option>
                        <option value="cus">Customer</option>
                    </select>

                    <label
                        class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey
               peer-focus:text-darkGreen">
                        Role
                    </label>
                </div>
            </div>
        </div>

        <!-- SUBMIT -->
        <div class="flex gap-4">
    <!-- SAVE BUTTON -->
    <button
        type="submit"
        class="bg-darkGreen text-white text-sm font-medium
               px-12 md:px-16 py-3 rounded-lg
               hover:bg-darkGreen/90 transition">
        Save
    </button>

    <!-- DELETE BUTTON -->
    <button
        type="button"
        class="flex items-center gap-3
               bg-red text-white text-sm font-medium
               px-8 py-3 rounded-lg
               hover:bg-red/90 transition">
        <i class="fa-solid fa-trash-alt"></i>
        Delete Account
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

        function toggleConfirmPassword() {
            const input = document.getElementById('confirmPassword');
            const icon = document.getElementById('eyeIconConfirm');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endpush