<h2 class="text-lg font-semibold mb-6">{{ __('account.my_testimonial') }}</h2>

<!-- TABS -->
<div class="flex w-full bg-softGrey rounded-xl mb-8 overflow-hidden">
    <!-- Pending -->
    <button id="tab-pending" onclick="switchTab('pending')"
        class="flex-1
           flex flex-col md:flex-row
           items-center
           justify-center
           text-sm font-medium
           bg-white text-darkGreen
           py-3 px-4 transition">
        <span>{{ __('account.pending_testimonial') }}</span>

        @if ($pendingCount > 0)
            <span
                class="inline-flex items-center justify-center
           w-5 h-5
           text-xs
           bg-red text-white
           rounded-full
           mt-2 md:mt-0
           md:ml-3">
                {{ $pendingCount }}
            </span>
        @endif
    </button>

    <!-- My -->
    <button id="tab-my" onclick="switchTab('my')"
        class="flex-1 
    flex flex-col md:flex-row
           items-center
           justify-center
           text-sm font-medium
           bg-softGrey text-mediumGrey
           py-3 px-4 transition">
        {{ __('account.my_testimonial') }}
    </button>
</div>

<!-- CONTENT PENDING -->
<div id="content-pending" class="space-y-4 py-6">

    @forelse($pendingReviews as $booking)
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 {{ !$loop->last ? 'border-b pb-4' : '' }}">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $booking->package->image_url) }}"
                    class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover">

                <div>
                    <h3 class="font-semibold text-darkGrey text-sm">
                        {{ app()->getLocale() === 'id' ? $booking->package->name_id : $booking->package->name_en }}</h3>

                    <p class="text-sm text-darkGreen flex items-center gap-2 mt-1">
                        <i class="fa-regular fa-calendar"></i>
                        {{ app()->getLocale() === 'id' ? $booking->tour_date->format('d M Y') : $booking->tour_date->translatedFormat('d M Y') }}
                    </p>
                </div>
            </div>

            <a href="{{ route('testimonials.create', $booking->id) }}"
                class="bg-darkGreen text-white text-sm
                  px-5 py-2 rounded-lg
                  hover:opacity-90
                  w-full md:w-auto
                  text-center mt-2 md:mt-0">
                {{ __('account.review') }}
            </a>
        </div>

    @empty

        <div class="col-span-12 flex flex-col items-center justify-center py-20 text-center">
            <img src="{{ asset('images/empty.png') }}" alt="Empty Booking" class="w-48 mb-8">
            <h3 class="text-lg font-semibold text-darkGrey mb-2">
                {{ __('account.empty_pending_title') }}
            </h3>
            <p class="text-sm text-mediumGrey max-w-md">
                {{ __('account.empty_pending_desc') }}
            </p>
        </div>
    @endforelse

</div>

<!-- CONTENT MY -->
<div id="content-my" class="hidden space-y-4 py-6">

    @forelse($myReviews as $review)
        <!-- ITEM -->
        <div
            class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 {{ !$loop->last ? 'border-b pb-4' : '' }}">

            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $review->booking->package->image_url) }}"
                    class="w-24 h-20 md:w-28 md:h-20 rounded-xl object-cover">

                <div>
                    <h3 class="font-semibold text-darkGrey text-sm">
                        {{ app()->getLocale() === 'id' ? $review->booking->package->name_id : $review->booking->package->name_en }}
                    </h3>
                    <p class="text-sm text-darkGreen flex items-center gap-2 mt-1">
                        <i class="fa-regular fa-calendar"></i>
                        {{ $review->booking->tour_date->format('d M Y') }}
                    </p>
                    <div class="flex gap-1 text-yellow-400 text-sm mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= $review->rating ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"></i>
                        @endfor
                    </div>

                </div>
            </div>

            <!-- ACTION -->
            <div class="flex gap-4 mt-2 md:mt-1 md:justify-end">
                <button onclick='openReviewModal(@json($review->load('package', 'user')))'
                    class="flex items-center gap-1 text-sm text-darkGreen hover:text-darkGreen/60">
                    <i class="fa-regular fa-eye"></i>
                    {{ __('account.view') }}
                </button>

                <!-- REVIEW MODAL -->
                <div id="reviewModal"
                    class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

                    <div class="bg-white rounded-2xl p-6 max-w-lg w-full relative animate-fadeIn">

                        <!-- CLOSE -->
                        <button onclick="closeReviewModal()"
                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>

                        <div id="modalContent"></div>

                    </div>
                </div>

                <form action="{{ route('testimonials.destroy', $review->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="openDeleteModal(this)"
                        class="flex items-center gap-1 text-sm text-red hover:text-red/60">
                        <i class="fa-regular fa-trash-can"></i>
                        {{ __('account.delete') }}
                    </button>
                </form>

                <!-- DELETE MODAL -->
<div id="deleteModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">

        <h2 class="text-lg font-semibold text-darkGrey mb-3">
            {{ __('account.delete_title') }}
        </h2>

        <p class="text-sm text-mediumGrey">
            {{ __('account.delete_desc_1') }}
        </p>

        <p class="text-sm text-mediumGrey mb-6">
            {{ __('account.delete_desc_2') }}
        </p>

        <div class="flex justify-end gap-3">
            <!-- Cancel -->
            <button onclick="closeDeleteModal()"
                class="px-4 py-2 rounded-lg border border-mediumGrey hover:bg-lightGrey">
                {{ __('account.cancel') }}
            </button>

            <!-- Yes Delete -->
            <button onclick="submitDelete()"
                class="px-4 py-2 rounded-lg bg-red text-white hover:bg-red/90">
                {{ __('account.yes_delete') }}
            </button>
        </div>
    </div>
</div>

            </div>

        </div>

    @empty

        <div class="col-span-12 flex flex-col items-center justify-center py-20 text-center">
            <img src="{{ asset('images/empty.png') }}" alt="Empty Review" class="w-48 mb-8">
            <h3 class="text-lg font-semibold text-darkGrey mb-2">
                {{ __('account.empty_my_title') }}
            </h3>
            <p class="text-sm text-mediumGrey max-w-md">
                {{ __('account.empty_my_desc') }}
            </p>
        </div>

    @endforelse

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

        function openReviewModal(review) {

            const modal = document.getElementById('reviewModal');
            const content = document.getElementById('modalContent');
            const date = new Date(review.created_at);

const formatted = date.toLocaleDateString('en-GB', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
});

            let stars = '';
            for (let i = 1; i <= 5; i++) {
                stars +=
                    `<i class="fa-star ${i <= review.rating ? 'fa-solid text-yellow-400':'fa-regular text-gray-300'}"></i>`;
            }

            let images = '';
            if (review.images && review.images.length) {
                images = `
        <div class="flex gap-3 overflow-x-auto pb-2 mb-5">
            ${review.images.map(img =>
                `<a href="/storage/${img}" target="_blank">
                        <img src="/storage/${img}" 
                             class="w-28 h-20 object-cover rounded-lg hover:scale-105 transition cursor-pointer">
                    </a>`
            ).join('')}
        </div>`;
            }

            content.innerHTML = `
        <div class="flex justify-between items-center mb-2">
            <p class="text-xs font-semibold text-darkGreen">
                ${review.package.name_en ?? review.package.name_id}
            </p>

            <i class="fas fa-quote-right text-3xl text-darkGreen/10"></i>
        </div>

        <div class="flex gap-1 mb-3">
            ${stars}
        </div>

        <p class="text-sm text-darkGrey leading-relaxed mb-6">
            ${review.comment}
        </p>

        ${images}

        <div class="flex items-center gap-3 mt-auto border-t pt-4">
            ${
                review.user?.profile_image
                ? `<img src="/storage/${review.user.profile_image}" 
                                 class="w-11 h-11 rounded-full object-cover">`
                : `<div class="w-11 h-11 rounded-full bg-darkGreen flex items-center justify-center text-white">
                                    <i class="fas fa-user text-sm"></i>
                               </div>`
            }
                               

            <div>
                <p class="font-medium text-sm">
                    ${review.user.first_name} ${review.user.last_name}
                </p>
                <p class="text-xs">
                    • ${formatted}
                </p>
            </div>
        </div>
    `;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // close kalau klik backdrop
        document.getElementById('reviewModal')
            .addEventListener('click', function(e) {
                if (e.target === this) {
                    closeReviewModal();
                }
            });

            let deleteForm = null;

function openDeleteModal(button){
    deleteForm = button.closest("form");
    document.getElementById("deleteModal").classList.remove("hidden");
    document.getElementById("deleteModal").classList.add("flex");
}

function closeDeleteModal(){
    document.getElementById("deleteModal").classList.add("hidden");
    document.getElementById("deleteModal").classList.remove("flex");
}

function submitDelete(){
    if(deleteForm){
        deleteForm.submit();
    }
}
    </script>
@endpush
