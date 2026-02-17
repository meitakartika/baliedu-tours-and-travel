@if ($paginator->hasPages())
<div class="flex justify-center mt-20">
    <nav class="flex items-center gap-2">

        {{-- First --}}
        @if (! $paginator->onFirstPage())
            <a href="{{ $paginator->url(1) }}"
               class="hidden md:inline-flex w-11 h-11 rounded-full border items-center justify-center text-darkGrey/80">
                «
            </a>
        @endif

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/40">
                ‹
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/80">
                ‹
            </a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            {{-- "..." --}}
            @if (is_string($element))
                <span class="hidden md:inline px-2 text-darkGrey">{{ $element }}</span>
            @endif

            {{-- Page Numbers --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="w-10 h-10 md:w-11 md:h-11 rounded-full bg-darkGreen text-white font-medium flex items-center justify-center">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/80">
                ›
            </a>
        @else
            <span class="w-10 h-10 md:w-11 md:h-11 rounded-full border flex items-center justify-center text-darkGrey/40">
                ›
            </span>
        @endif

        {{-- Last --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->url($paginator->lastPage()) }}"
               class="hidden md:inline-flex w-11 h-11 rounded-full border items-center justify-center text-darkGrey/80">
                »
            </a>
        @endif

    </nav>
</div>
@endif
