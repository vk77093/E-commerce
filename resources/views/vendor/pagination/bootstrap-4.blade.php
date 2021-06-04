@if ($paginator->hasPages())
    <nav class="navigation align-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                            <a href="#" class="page-numbers bg-border-color current"><span>{{ $page }}</span></a>
                        @else
                            {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                            <a href="{{ $url }}" class="page-numbers bg-border-color current"><span>{{ $page }}</span></a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}
                <svg class="btn-prev">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            @else
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li> --}}
                <svg class="btn-next">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            @endif
        
    </nav>
@endif
