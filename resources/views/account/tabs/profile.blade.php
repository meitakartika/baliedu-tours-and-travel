<!-- ================= PERSONAL INFORMATION ================= -->

<h2 class="text-lg font-semibold mb-7">Personal Information</h2>

<form class="space-y-7">

    <!-- First & Last Name -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="relative">
            <input type="text" name="first_name"
                class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen" />
            <label
                class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                First Name
            </label>
        </div>

        <div class="relative">
            <input type="text" name="last_name"
                class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen" />
            <label
                class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                Last Name
            </label>
        </div>

    </div>

    <!-- Phone -->
    <div class="relative">
        <input type="text" name="phone"
            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                   focus:outline-none focus:border-darkGreen" />
        <label
            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
            Phone Number
        </label>
    </div>

    <!-- Date of Birth -->
    <div class="relative">
        <input type="date" name="birth"
            class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                   focus:outline-none focus:border-darkGreen" />
        <label
            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
            Date of Birth
        </label>
    </div>

    <!-- Country -->
    <div class="relative">
        <select name="country"
            class="peer bg-white w-full border border-lightGrey rounded-md
                   px-3 text-sm h-12 focus:outline-none focus:border-darkGreen text-darkGrey"
            required>
            <option value="" disabled selected hidden></option>
            <option value="id">Indonesia</option>
            <option value="au">Australia</option>
            <option value="us">United States</option>
        </select>

        <label
            class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white
                   peer-focus:text-darkGreen">
            Country
        </label>
    </div>

    <!-- Button -->
    <button
                    class="w-1/2 bg-darkGreen text-white py-3 rounded-lg
                           font-medium hover:bg-darkGreen/90 transition">
                    Update Profile
                </button>

</form>

<!-- ================= DIVIDER ================= -->
<div class="my-8 border-t border-mediumGrey/20"></div>

<!-- ================= SECURITY ================= -->

    <h2 class="text-lg font-semibold mb-7">Security</h2>

    <form class="space-y-7">

        <!-- Email -->
        <div class="relative">
            <input type="email" value="johndoe@gmail.com"
                class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12
                       focus:outline-none focus:border-darkGreen">
            <label
                class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                Email
            </label>
        </div>

        <!-- Password -->
        <div class="relative">
            <input type="password"
                class="bg-white w-full border border-lightGrey rounded-md px-3 text-sm h-12 pr-10
                       focus:outline-none focus:border-darkGreen">
            <label
                class="absolute left-2 -top-2 px-1 text-darkGrey text-sm bg-white">
                Password
            </label>

            <span
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer">
                <i class="fa-regular fa-eye-slash"></i>
            </span>
        </div>

        <!-- Button -->
        <button
                    class="w-1/2 bg-darkGreen text-white py-3 rounded-lg
                           font-medium hover:bg-darkGreen/90 transition">
                    Change
                </button>

    </form>