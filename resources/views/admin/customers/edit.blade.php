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
            Edit Customer
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

            <!-- FORM -->
            <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data"
                class="space-y-10">

                @csrf
                @method('PUT')

                <!-- AVATAR -->
                <div class="flex justify-center">
                    <label class="relative cursor-pointer">
                        <input type="file" name="profile_image" id="avatar" class="hidden">
                        <div
                            class="w-36 h-36 rounded-full bg-mediumGrey/10 flex items-center justify-center overflow-hidden">
                            <img id="preview"
                                src="{{ $customer->profile_image ? asset('storage/' . $customer->profile_image) : '' }}"
                                class="w-full h-full object-cover {{ $customer->profile_image ? '' : 'hidden' }}">

                            @if (!$customer->profile_image)
                                <i id="icon" class="fa-regular fa-image text-3xl text-darkGrey"></i>
                            @endif

                        </div>
                    </label>
                </div>

                <!-- INPUTS -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- First Name -->
                    <div class="relative mt-4">
                        <input type="text" name="first_name" placeholder="Enter your first name"
                            value="{{ old('first_name', $customer->first_name) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            First Name
                        </label>
                    </div>

                    <!-- Last Name -->
                    <div class="relative mt-4">
                        <input type="text" name="last_name" placeholder="Enter your last name"
                            value="{{ old('last_name', $customer->last_name) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Last Name
                        </label>
                    </div>

                    <!-- Email -->
                    <div class="relative mt-2">
                        <input type="email" name="email" placeholder="Enter your email"
                            value="{{ old('email', $customer->email) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Email
                        </label>
                    </div>

                    <!-- Phone -->
                    <div class="relative mt-2">
                        <input type="text" name="phone" placeholder="Enter your phone number"
                            value="{{ old('phone', $customer->phone) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Phone Number
                        </label>
                    </div>

                    <!-- Date -->
                    <div class="relative mt-2">
                        <input type="date" name="date_of_birth"
                            value="{{ old('date_of_birth', $customer->date_of_birth) }}"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center
                   focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Date of Birth (Optional)
                        </label>
                    </div>

                    <!-- Country -->
                    <div class="relative mt-2">
                        <select name="country"
                            class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
               text-darkGrey"
                            required>

                            <option value="" disabled selected hidden
                                {{ old('country', $customer->country) ? '' : 'selected' }}>
                                Select country
                            </option>

                            @foreach ($countries as $code => $name)
                                <option value="{{ $code }}"
                                    {{ old('country', $customer->country ?? '') == $code ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>

                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
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
                        <input type="password" name="password_confirmation" placeholder="Confirm your password"
                            id="confirmPassword"
                            class="bg-softGrey w-full border border-mediumGrey rounded-md px-3 text-sm h-12 flex items-center focus:outline-none focus:border-darkGreen" />
                        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-softGrey">
                            Confirm Password
                        </label>
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
                            onclick="toggleConfirmPassword()">
                            <i class="fa-solid fa-eye" id="eyeIconConfirm"></i>
                        </button>
                    </div>

                    <!-- Role -->
                    <div class="md:col-span-2">
                        <div class="relative mt-2">
                            <select name="role"
                                class="peer appearance-none bg-softGrey w-full border border-mediumGrey rounded-md
               px-3 text-sm h-12 focus:outline-none focus:border-darkGreen
               text-darkGrey"
                                required>
                                <option value="" disabled hidden
                                    {{ old('role', $customer->role ?? '') == '' ? 'selected' : '' }}>
                                </option>
                                <option value="admin" {{ old('role', $customer->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="user" {{ old('role', $customer->role) == 'user' ? 'selected' : '' }}>
                                    Customer
                                </option>
                            </select>

                            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>

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

                    <!-- SAVE -->
                    <button type="submit"
                        class="bg-darkGreen text-white text-sm font-medium 
        px-12 md:px-16 py-3 rounded-lg hover:bg-darkGreen/90 transition">
                        Save
                    </button>

            </form>

            <!-- DELETE -->
            <form id="deleteCustomer" action="{{ route('customers.destroy', $customer) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="button"
                    onclick="confirmDelete('deleteCustomer', 'Delete Customer?')"
                    class="bg-red text-white text-sm font-medium
                    px-8 py-3 rounded-lg hover:bg-red/90 transition">
                    Delete Account
                </button>
            </form>

            </div>

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

        //Profile Image
        document.getElementById('avatar').addEventListener('change', function(e) {

            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            const icon = document.getElementById('icon');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');

                if (icon) {
                    icon.style.display = 'none';
                }
            }
        });
    </script>
@endpush
