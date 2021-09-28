@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="paginations-box">
        <ul class="pagination" style="margin: auto">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                
            @else
                @if (!empty($all))
                <?php $page_prev = $paginator->currentPage() - 1 ?>
                <li class="pagi-prev">
                    <a href="{{ route('home.search-all', array_merge($all, ['page' => $page_prev])) }}">
                        <i class="fa fa-angle-double-left icon icon-prev" aria-hidden="true"></i>
                    </a>
                </li>
                @else
                <li class="pagi-prev">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa fa-angle-double-left icon icon-prev" aria-hidden="true"></i>
                    </a>
                </li>
                @endif
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if (!empty($all))
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="{{ route('home.search-all', array_merge($all, ['page' => $page])) }}">{{ $page }}</a></li>
                            @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                                <li><a href="{{ route('home.search-all', array_merge($all, ['page' => $page])) }}">{{ $page }}</a></li>
                            @elseif ($page == $paginator->lastPage() - 1 || $page == $paginator->lastPage() - 2 || $paginator->currentPage())
                                <li><a href="{{ route('home.search-all', array_merge($all, ['page' => $page])) }}">{{ $page }}</a></li>
                            @endif
                        @else
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>
                            @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @elseif ($page == $paginator->lastPage() - 1 || $page == $paginator->lastPage() - 2 || $paginator->currentPage())
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                @if (!empty($all))
                <?php $page_next = $paginator->currentPage() + 1 ?>
                <li class="pagi-next">
                    <a href="{{ route('home.search-all', array_merge($all, ['page' => $page_next])) }}">
                        <i class="fa fa-angle-double-right icon icon-next" aria-hidden="true"></i>
                    </a>
                </li>
                @else
                <li class="pagi-next">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa fa-angle-double-right icon icon-next" aria-hidden="true"></i>
                    </a>
                </li>
                @endif
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif
