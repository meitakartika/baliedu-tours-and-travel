@extends('layout.admin')

@section('title', __('admin.account_setting'))

@section('content')
    <section class="w-full">

        <!-- BACK -->
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 font-medium text-mediumGrey hover:text-darkGreen mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('admin.back') }}
        </a>

        <!-- TITLE -->
        <h1 class="text-center text-darkGreen font-semibold text-lg mb-10">
            {{ __('admin.account_setting') }}
        </h1>

        <!-- AVATAR -->
        <form action="{{ route('admin.account.profile.image') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex justify-center">
                <label class="relative cursor-pointer">

                    <input type="file" name="profile_image" class="hidden"
                        onchange="this.form.submit(); previewAvatar(this);">

                    <!-- Avatar -->
                    <div class="w-36 h-36 rounded-full overflow-hidden bg-mediumGrey/50 flex items-center justify-center"
                        id="avatarPreview">
                        @if ($admin->profile_image)
                            <img src="{{ asset('storage/' . $admin->profile_image) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-user text-6xl text-white"></i>
                        @endif
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
        </form>

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.account.updateProfile') }}" enctype="multipart/form-data"
            class="space-y-12">
            @csrf
            @method('PUT')

            <!-- Personal Information -->
            <div class="bg-white rounded-3xl shadow-sm p-8">

                {{-- ================= PROFILE MESSAGE ================= --}}
                @if (session('success_profile'))
                    <div class="mb-6 rounded-lg bg-lightGreen/20 border border-darkGreen/80 p-4 text-darkGreen text-sm">
                        {{ session('success_profile') }}
                    </div>
                @endif

                @if ($errors->profile->any())
                    <div class="mb-6 rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->profile->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="font-semibold text-base text-darkGrey mb-8">
                    {{ __('admin.personal_information') }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div class="relative">
                        <input type="text" name="first_name" value="{{ $admin->first_name }}"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            {{ __('admin.first_name') }}
                        </label>
                    </div>

                    <!-- Last Name -->
                    <div class="relative">
                        <input type="text" name="last_name" value="{{ $admin->last_name }}"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            {{ __('admin.last_name') }}
                        </label>
                    </div>

                    <!-- Phone -->
                    <div class="relative col-span-2">
                        <input type="text" name="phone" value="{{ $admin->phone }}"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            {{ __('admin.phone_number') }}
                        </label>
                    </div>

                    <!-- Date -->
                    <div class="relative">
                        <input type="date" name="date_of_birth" value="{{ $admin->date_of_birth }}"
                            class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            {{ __('admin.date_of_birth') }}
                        </label>
                    </div>

                    <!-- Country -->
                    <div class="relative">
                        <select name="country"
                            class="peer bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen appearance-none">
                            <option value="">{{ __('admin.select_country') }}</option>
                            @foreach ($countries as $code => $name)
                                <option value="{{ $code }}" {{ $admin->country == $code ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"> <i
                                class="fa-solid fa-chevron-down text-xs"></i> </span>
                        <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                            {{ __('admin.country_optional') }}
                        </label>
                    </div>
                </div>

                <button type="button" onclick="openConfirmProfile()"
                    class="mt-8 bg-darkGreen text-white px-16 py-3 rounded-lg text-sm font-medium">
                    {{ __('admin.update') }}
                </button>
            </div>

            <!-- ===== CONFIRM UPDATE PROFILE MODAL ===== -->
            <div id="confirmProfileModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

                <div class="bg-white rounded-xl p-6 w-full max-w-sm">
                    <h3 class="text-lg font-semibold mb-3 text-darkGreen">{{ __('admin.confirm_update') }}</h3>

                    <p class="text-sm mb-6 text-mediumGrey">
                        {{ __('admin.confirm_update_text') }}
                    </p>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeConfirmProfile()"
                            class="px-4 py-2 rounded-md border border-lightGrey text-mediumGrey hover:bg-lightGrey/40 transition">
                            {{ __('admin.cancel') }}
                        </button>

                        <button type="submit"
                            class="px-4 py-2 rounded-md bg-darkGreen text-white hover:bg-darkGreen/90 transition">
                            {{ __('admin.yes_update') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Security -->

        <form method="POST" action="{{ route('admin.account.updateSecurity') }}"
            class="bg-white rounded-3xl shadow-sm p-8 mt-8">
            @csrf
            @method('PUT')

            {{-- ================= SECURITY MESSAGE ================= --}}
            @if (session('success_security'))
                <div class="mb-6 rounded-lg bg-lightGreen/20 border border-darkGreen/80 p-4 text-darkGreen text-sm">
                    {{ session('success_security') }}
                </div>
            @endif

            @if ($errors->security->any())
                <div class="mb-6 rounded-lg bg-red/5 border border-red/80 p-4 text-red text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->security->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="font-semibold text-base text-darkGrey mb-8">
                {{ __('admin.security') }}
            </h2>

            <div class="space-y-6">

                <!-- Email -->
                <div class="relative">
                    <input type="email" name="email" value="{{ $admin->email }}"
                        class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                    <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                        {{ __('admin.email') }}
                    </label>
                </div>

                <!-- Password -->
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="{{ __('admin.password') }}"
                        class="bg-white w-full border border-mediumGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
                    <label class="absolute left-2 -top-2 px-1 bg-white text-sm text-darkGrey">
                        {{ __('admin.password') }}
                    </label>

                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
                        onclick="togglePassword()">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="button" onclick="openConfirmSecurity()"
                class="mt-8 bg-darkGreen text-white px-16 py-3 rounded-lg text-sm font-medium">
                {{ __('admin.change') }}
            </button>

            <!-- ===== CONFIRM SECURITY MODAL ===== -->
            <div id="confirmSecurityModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

                <div class="bg-white rounded-xl p-6 w-full max-w-sm">
                    <h3 class="text-lg font-semibold mb-3 text-darkGreen">
                        {{ __('admin.confirm_change') }}
                    </h3>

                    <p class="text-sm text-mediumGrey mb-6">
                        {{ __('admin.confirm_change_text') }}
                    </p>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeConfirmSecurity()"
                            class="px-4 py-2 rounded-md border border-lightGrey text-mediumGrey hover:bg-lightGrey/40 transition">
                            {{ __('admin.cancel') }}
                        </button>

                        <button type="submit"
                            class="px-4 py-2 rounded-md bg-darkGreen text-white hover:bg-darkGreen/90 transition">
                            {{ __('admin.yes_change') }}
                        </button>
                    </div>
                </div>
            </div>

        </form>

    </section>
@endsection

@push('scripts')
    <script>
        function previewAvatar(input) {
            const preview = document.getElementById('avatarPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.innerHTML =
                    `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                reader.readAsDataURL(input.files[0]);
            }
        }

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

        function openConfirmProfile() {
            document.getElementById('confirmProfileModal').classList.remove('hidden');
            document.getElementById('confirmProfileModal').classList.add('flex');
        }

        function closeConfirmProfile() {
            document.getElementById('confirmProfileModal').classList.add('hidden');
            document.getElementById('confirmProfileModal').classList.remove('flex');
        }

        function openConfirmSecurity() {
            document.getElementById('confirmSecurityModal').classList.remove('hidden');
            document.getElementById('confirmSecurityModal').classList.add('flex');
        }

        function closeConfirmSecurity() {
            document.getElementById('confirmSecurityModal').classList.add('hidden');
            document.getElementById('confirmSecurityModal').classList.remove('flex');
        }
    </script>
@endpush
