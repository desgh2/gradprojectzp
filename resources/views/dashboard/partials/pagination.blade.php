
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="paginate_button page-item previous disabled">
            <i class="previous"></i>
        </li>
        @else
        <li class="paginate_button page-item previous disabled">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                <i class="previous"></i>
            </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="paginate_button page-item">
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next">
                <a href="{{ $paginator->nextPageUrl() }}"><i class="next"></i></a>
            </li>
        @else
            <li class="paginate_button page-item next">
                <a href="{{ $paginator->nextPageUrl() }}"><i class="next"></i></a>
            </li>
        @endif
    </ul>
@endif