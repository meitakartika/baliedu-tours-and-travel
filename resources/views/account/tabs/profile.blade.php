<style>
    input::placeholder {
        font-size: 0.75rem;
    }

    input[type="date"] {
        font-size: 0.75rem;
        color: #9CA3AF;
    }

    input[type="date"]::-webkit-datetime-edit {
        font-size: 0.75rem;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.6;
    }

    select:has(option:checked[value=""]) {
    font-size: 0.75rem;
    color: #9CA3AF;
}
</style>

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

<!-- ================= PERSONAL INFORMATION ================= -->

<h2 class="text-lg font-semibold mb-7">Personal Information</h2>

<form id="profileForm" method="POST" action="{{ route('account.profile') }}">
    @csrf
    @method('PUT')

    <!-- First & Last Name -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="relative mb-7">
            <input type="text" name="first_name"
                value="{{ old('first_name', $user->first_name) }}"
                class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
            <label class="absolute left-2 -top-2 bg-white px-1 text-sm text-darkGrey">First Name</label>
        </div>

        <div class="relative mb-7">
            <input type="text" name="last_name"
                value="{{ old('last_name', $user->last_name) }}"
                class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
            <label class="absolute left-2 -top-2 bg-white px-1 text-sm text-darkGrey">Last Name</label>
        </div>
    </div>

    <!-- Phone -->
    <div class="relative mb-7">
        <input type="text" name="phone"
            value="{{ old('phone', $user->phone) }}"
            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
        <label class="absolute left-2 -top-2 bg-white px-1 text-sm text-darkGrey">Phone</label>
    </div>

    <!-- Date -->
    <div class="relative mb-7">
        <input type="date" name="date_of_birth"
            value="{{ old('date_of_birth', $user->date_of_birth) }}"
            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 focus:outline-none focus:border-darkGreen" />
        <label class="absolute left-2 -top-2 bg-white px-1 text-sm text-darkGrey">Date of Birth</label>
    </div>

    <!-- Country -->
    <div class="relative mb-7">
        <select name="country" class="peer bg-white w-full border border-lightGrey rounded-md px-3 pr-10 text-sm h-12 focus:outline-none focus:border-darkGreen text-darkGrey appearance-none">
            <option value="">Select country</option>
            @foreach ($countries as $code => $name)
                <option value="{{ $code }}" {{ $user->country == $code ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"> <i class="fa-solid fa-chevron-down text-xs"></i> </span>
        <label class="absolute left-2 -top-2 bg-white px-1 text-sm text-darkGrey">Country</label>
    </div>

    <!-- OPEN MODAL -->
    <button type="button"
        onclick="openConfirmProfile()"
        class="w-1/2 bg-darkGreen text-white py-3 rounded-lg font-medium hover:bg-darkGreen/90 transition">
        Update Profile
    </button>

    <!-- ===== CONFIRM UPDATE PROFILE MODAL ===== -->
    <div id="confirmProfileModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl p-6 w-full max-w-sm">
            <h3 class="text-lg font-semibold mb-3 text-darkGreen">Confirm Update</h3>

            <p class="text-sm mb-6 text-mediumGrey">
                Are you sure you want to update your personal information?
            </p>

            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="closeConfirmProfile()"
                    class="px-4 py-2 rounded-md border border-lightGrey text-mediumGrey hover:bg-lightGrey/40 transition">
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-md bg-darkGreen text-white hover:bg-darkGreen/90 transition">
                    Yes, Update
                </button>
            </div>
        </div>
    </div>
</form>

<!-- ================= DIVIDER ================= -->
<div class="my-8 border-t border-mediumGrey/20"></div>

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

<!-- ================= SECURITY ================= -->

<h2 class="text-lg font-semibold mb-7">Security</h2>

<form id="securityForm" method="POST" action="{{ route('account.security') }}" class="space-y-7">
    @csrf
    @method('PUT')

    <!-- Email -->
    <div class="relative">
        <input type="email" name="email" value="{{ $user->email }}"
            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
            Email
        </label>
    </div>

    <!-- Password -->
    <div class="relative">
        <input type="password" name="password" id="password"
            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 pr-10
               focus:outline-none focus:border-darkGreen"
            placeholder="New password">

        <label class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
            Password
        </label>

        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-mediumGrey"
            onclick="togglePassword()">
            <i class="fa-regular fa-eye-slash" id="eyeIcon"></i>
        </button>
    </div>

    <!-- Button -->
    <button type="button" onclick="openConfirmSecurity()"
        class="w-1/2 bg-darkGreen text-white py-3 rounded-lg
           font-medium hover:bg-darkGreen/90 transition">
        Change
    </button>

    <!-- ===== CONFIRM SECURITY MODAL ===== -->
    <div id="confirmSecurityModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl p-6 w-full max-w-sm">
            <h3 class="text-lg font-semibold mb-3 text-darkGreen">
                Confirm Change
            </h3>

            <p class="text-sm text-mediumGrey mb-6">
                Are you sure you want to change your email or password?
            </p>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeConfirmSecurity()"
                    class="px-4 py-2 rounded-md border border-lightGrey text-mediumGrey hover:bg-lightGrey/40 transition">
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-md bg-darkGreen text-white hover:bg-darkGreen/90 transition">
                    Yes, Change
                </button>
            </div>
        </div>
    </div>

</form>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');

        if (input.type === 'text') {
            input.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
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
