@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="w-full">
        {{-- ==================== MOBILE VIEW ==================== --}}
        <div class="flex md:hidden items-center justify-between gap-3 w-full px-4 py-3 bg-white/40 backdrop-blur-sm border border-primary/10 rounded-2xl">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-300 bg-white/50 border border-primary/5 rounded-lg cursor-not-allowed">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-700 bg-white border border-primary/10 rounded-lg hover:border-secondary hover:text-secondary hover:shadow-sm transition-all duration-200">
                    Sebelumnya
                </a>
            @endif

            {{-- Page Status --}}
            <span class="text-xs font-medium text-gray-500">
                Hal. <span class="font-bold text-accent-green">{{ $paginator->currentPage() }}</span> dari <span class="font-bold text-accent-green">{{ $paginator->lastPage() }}</span>
            </span>

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-700 bg-white border border-primary/10 rounded-lg hover:border-secondary hover:text-secondary hover:shadow-sm transition-all duration-200">
                    Berikutnya
                </a>
            @else
                <span class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-300 bg-white/50 border border-primary/5 rounded-lg cursor-not-allowed">
                    Berikutnya
                </span>
            @endif
        </div>

        {{-- ==================== DESKTOP VIEW ==================== --}}
        <div class="hidden md:flex items-center justify-between gap-4 w-full px-5 py-4 bg-white/40 backdrop-blur-sm border border-primary/10 rounded-2xl">
            {{-- Left Info: Showing entries count --}}
            <div class="text-xs text-gray-500">
                {!! __('Menampilkan') !!}
                @if ($paginator->firstItem())
                    <span class="font-bold text-accent-green">{{ $paginator->firstItem() }}</span>
                    {!! __('sampai') !!}
                    <span class="font-bold text-accent-green">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('dari') !!}
                <span class="font-bold text-accent-green">{{ $paginator->total() }}</span>
                {!! __('artikel') !!}
            </div>

            {{-- Right: Pagination Links --}}
            <div class="flex items-center gap-1.5">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-300 bg-white/50 border border-primary/5 cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-600 bg-white border border-primary/10 hover:border-secondary hover:text-secondary hover:shadow-sm transition-all duration-200" aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="inline-flex items-center justify-center w-8 h-8 text-xs text-gray-400">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-white bg-primary rounded-lg border border-primary shadow-sm shadow-primary/10">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="inline-flex items-center justify-center w-8 h-8 text-xs font-semibold text-gray-600 bg-white rounded-lg border border-primary/10 hover:border-secondary hover:text-secondary hover:shadow-sm transition-all duration-200" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-600 bg-white border border-primary/10 hover:border-secondary hover:text-secondary hover:shadow-sm transition-all duration-200" aria-label="{{ __('pagination.next') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                @else
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-300 bg-white/50 border border-primary/5 cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
