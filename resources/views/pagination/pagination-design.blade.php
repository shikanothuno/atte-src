
<link rel="stylesheet" href="{{ asset("css/pagination/pagination-design.css") }}">
@if ($paginator->hasPages())
    <nav>
        <table class="pagination">
            <tr>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <td class="page-item disabled" aria-disabled="true">
                        <span aria-hidden="true">&lsaquo;</span>
                    </td>
                @else
                    <td class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                    </td>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <td class="page-item disabled" aria-disabled="true"><span>{{ $element }}</span></td>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <td class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></td>
                            @else
                                <td class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></td>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <td class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                    </td>
                @else
                    <td class="page-item disabled" aria-disabled="true">
                        <span aria-hidden="true">&rsaquo;</span>
                    </td>
                @endif
            </tr>
        </table>
    </nav>
@endif
