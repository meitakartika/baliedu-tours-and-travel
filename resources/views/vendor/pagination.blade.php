@if ($paginator->hasPages())
    <div class="flex justify-center mt-20">
        <nav class="flex items-center gap-2">

            {{-- First --}}
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->url(1) }}"
                    class="hidden md:inline-flex w-11 h-11 rounded-full border items-center justify-center text-darkGrey/80 hover:bg-darkGrey/10
                      transition">
                    <i class="fa-solid fa-angles-left text-xs"></i>
                </a>
            @endif

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/40 cursor-not-allowed">
                    <i class="fa-solid fa-angle-left text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/80 hover:bg-darkGrey/10
                      transition">
                    <i class="fa-solid fa-angle-left text-xs"></i>
                </a>
            @endif

            {{-- Pages --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                $start = max($current - 1, 1);
                $end = min($start + 2, $last);

                if ($end - $start < 2) {
                    $start = max($end - 2, 1);
                }
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <span
                        class="w-10 h-10 md:w-11 md:h-11 rounded-full bg-darkGreen text-white font-medium flex items-center justify-center">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}"
                        class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey hover:bg-lightGreen/40 transition">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/80 hover:bg-darkGrey/10
                      transition">
                    <i class="fa-solid fa-angle-right text-xs"></i>
                </a>
            @else
                <span
                    class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/40 cursor-not-allowed">
                    <i class="fa-solid fa-angle-right text-xs"></i>
                </span>
            @endif

            {{-- Last --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->url($paginator->lastPage()) }}"
                    class="hidden md:inline-flex w-11 h-11 rounded-full border items-center justify-center text-darkGrey/80 hover:bg-darkGrey/10
                      transition">
                    <i class="fa-solid fa-angles-right text-xs"></i>
                </a>
            @endif

        </nav>
    </div>
@endif
