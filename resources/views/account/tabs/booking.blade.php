<h2 class="text-lg font-semibold mb-7">My Booking</h2>

<!-- TABLE HEADER (DESKTOP ONLY) -->
<div class="hidden md:grid grid-cols-12 text-sm text-mediumGrey font-medium pb-4 border-b border-mediumGrey/20">
    <div class="col-span-4">Tour Name</div>
    <div class="col-span-3 text-center">Price</div>
    <div class="col-span-3 text-center">Payment</div>
    <div class="col-span-2 text-center">Status</div>
</div>

<!-- BOOKING ITEM -->
<div
    class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-0
           py-6 border-b">

    <!-- TOUR INFO -->
    <div class="md:col-span-4 flex items-center gap-4">
        <img src="/images/category-1.png"
             class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover"
             alt="Fireflies Tour">

        <div>
            <h3 class="font-semibold text-darkGrey">Fireflies Tour</h3>

            <div class="flex items-center gap-2 text-sm text-darkGreen mt-1">
                <i class="fa-regular fa-calendar"></i>
                <span>12 Des 2025</span>
            </div>

            <div class="flex items-center gap-2 text-sm text-darkGreen mt-1">
                <i class="fa-solid fa-user-group"></i>
                <span>2 guests</span>
            </div>
        </div>
    </div>

    <!-- PRICE -->
    <div class="md:col-span-3 md:flex md:items-center md:justify-center 
                text-sm font-semibold text-darkGrey text-left md:text-center mt-1 md:mt-0">
        Rp. 1.000.000
    </div>

    <!-- PAYMENT -->
    <div class="md:col-span-3 md:flex md:items-center md:justify-center text-sm mt-1 md:mt-0">
        <a href="#"
           class="text-darkGreen font-medium hover:underline flex items-center gap-2">
            <i class="fa-regular fa-file-lines"></i>
            View Proof
        </a>
    </div>

    <!-- STATUS -->
    <div class="md:col-span-2 md:flex md:items-center md:justify-center
                text-left md:text-center mt-1 md:mt-0">
        <span
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                   bg-paleGreen/40 text-darkGreen text-sm font-medium">
            <i class="fa-solid fa-clock"></i>
            Verification
        </span>
    </div>
</div>

<!-- BOOKING ITEM (COMPLETED) -->
<div
    class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-0
           py-6">

    <div class="md:col-span-4 flex items-center gap-4">
        <img src="/images/category-1.png"
             class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover"
             alt="Fireflies Tour">

        <div>
            <h3 class="font-semibold text-darkGrey">Fireflies Tour</h3>

            <div class="flex items-center gap-2 text-sm text-darkGreen mt-1">
                <i class="fa-regular fa-calendar"></i>
                <span>12 Nov 2025</span>
            </div>

            <div class="flex items-center gap-2 text-sm text-darkGreen mt-1">
                <i class="fa-solid fa-user-group"></i>
                <span>3 guests</span>
            </div>
        </div>
    </div>

        <div class="md:col-span-3 md:flex md:items-center md:justify-center
                text-sm font-semibold text-darkGrey text-left md:text-center mt-1 md:mt-0">
        Rp. 1.500.000
    </div>

    <div class="md:col-span-3 md:flex md:items-center md:justify-center text-sm mt-1 md:mt-0">
        <a href="#"
           class="text-darkGreen font-medium hover:underline flex items-center gap-2">
            <i class="fa-regular fa-file-lines"></i>
            View Proof
        </a>
    </div>

    <div class="md:col-span-2 md:flex md:items-center md:justify-center
                text-left md:text-center mt-1 md:mt-0">
        <span
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                   bg-paleGreen/40 text-darkGreen text-sm font-medium">
            <i class="fa-solid fa-circle-check"></i>
            Completed
        </span>
    </div>
</div>
