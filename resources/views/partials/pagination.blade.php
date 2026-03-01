@if (isset($paginator) && $paginator->hasPages())
    <div class="d-flex justify-content-center pt-2">
        <nav>
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max($current - 2, 2);
                    $end = min($current + 2, $last - 1);
                @endphp

                <li class="page-item {{ $current === 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>

                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    <li class="page-item {{ $current === $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endfor

                @if ($end < $last - 1)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif

                @if ($last > 1)
                    <li class="page-item {{ $current === $last ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a>
                    </li>
                @endif

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
