<h2 class="text-lg font-semibold mb-6">My Testimonial</h2>

<!-- TABS -->
<div class="flex w-full bg-softGrey rounded-xl mb-8 overflow-hidden">
    <!-- Pending -->
<button
    id="tab-pending"
    onclick="switchTab('pending')"
    class="flex-1
           flex flex-col md:flex-row
           items-center
           justify-center
           text-sm font-medium
           bg-white text-darkGreen
           py-3 px-4 transition">
    <span>Pending Testimonial</span>

    <span
        class="inline-flex items-center justify-center
               w-5 h-5
               text-xs
               bg-red text-white
               rounded-full
               mt-2 md:mt-0
               md:ml-3">
        1
    </span>
</button>

<!-- My -->
<button id="tab-my"
    onclick="switchTab('my')"
    class="flex-1 
    flex flex-col md:flex-row
           items-center
           justify-center
           text-sm font-medium
           bg-softGrey text-mediumGrey
           py-3 px-4 transition">
    My Testimonial
</button>
</div>

<!-- CONTENT PENDING -->
<div id="content-pending" class="space-y-4 py-6 border-b">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
            <img src="/images/category-1.png"
                 class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover"
                 alt="Fireflies Tour">

            <div>
                <h3 class="font-semibold text-darkGrey">Fireflies Tour</h3>
                <p class="text-sm text-darkGreen flex items-center gap-2 mt-1">
                    <i class="fa-regular fa-calendar"></i>
                    12 Nov 2025
                </p>
            </div>
        </div>

        <a href="#"
           class="bg-darkGreen text-white text-sm
                  px-5 py-2 rounded-lg
                  hover:opacity-90
                  w-full md:w-auto
                  text-center mt-2 md:mt-0">
            Review
        </a>
    </div>

</div>

<!-- CONTENT MY -->
<div id="content-my" class="hidden space-y-4 py-6 border-b">

    <!-- ITEM -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

        <div class="flex items-center gap-4">
            <img src="/images/category-1.png"
                 class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover"
                 alt="Fireflies Tour">

            <div>
                <h3 class="font-semibold text-darkGrey">Fireflies Tour</h3>
                <p class="text-sm text-darkGreen flex items-center gap-2 mt-1">
                    <i class="fa-regular fa-calendar"></i>
                    12 Nov 2025
                </p>
                <p class="text-sm text-darkGreen mt-2">
                    ⭐⭐⭐⭐☆
                </p>

            </div>
        </div>

        <!-- ACTION -->
        <div class="flex gap-4 mt-2 md:mt-1 md:justify-end">
            <button class="flex items-center gap-1 text-sm text-darkGreen hover:text-darkGreen/60">
    <i class="fa-regular fa-eye"></i>
    View Review
</button>

            <button
                class="flex items-center gap-1 text-sm text-red hover:text-red/60">
                <i class="fa-regular fa-trash-can"></i>
                Delete
            </button>
        </div>

    </div>

</div>

@push('scripts')
<script>
function switchTab(tab) {
    const pendingTab = document.getElementById('tab-pending');
    const myTab = document.getElementById('tab-my');

    const pendingContent = document.getElementById('content-pending');
    const myContent = document.getElementById('content-my');

    if (tab === 'pending') {
        pendingContent.classList.remove('hidden');
        myContent.classList.add('hidden');

        pendingTab.classList.add('bg-white', 'text-darkGreen');
        pendingTab.classList.remove('bg-softGrey', 'text-mediumGrey');

        myTab.classList.add('bg-softGrey', 'text-mediumGrey');
        myTab.classList.remove('bg-white', 'text-darkGreen');
    } else {
        pendingContent.classList.add('hidden');
        myContent.classList.remove('hidden');

        myTab.classList.add('bg-white', 'text-darkGreen');
        myTab.classList.remove('bg-softGrey', 'text-mediumGrey');

        pendingTab.classList.add('bg-softGrey', 'text-mediumGrey');
        pendingTab.classList.remove('bg-white', 'text-darkGreen');
    }
}
</script>
@endpush
