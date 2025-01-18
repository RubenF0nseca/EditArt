<!-- Paginação -->
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">

        <!-- Link da página anterior -->
        <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $paginator->onFirstPage() }}">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>

        <!-- Elementos de paginação -->
        @php
            $show_dots_start = false;
            $show_dots_end = false;
        @endphp

        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            <!-- Mostra as primeiras 3 páginas, as últimas 3 páginas e as 1 página à volta da página actual -->
            @if ($page <= 3 || $page >= $paginator->lastPage() - 2 || ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1))
                <li>
                    <a href="{{ $paginator->url($page) }}" class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                </li>
            @elseif ($page > 3 && $page < $paginator->currentPage() - 1 && !$show_dots_start)
                <!-- Reticências para páginas anteriores não exibidas -->
                @php $show_dots_start = true; @endphp
                <li class="disabled" id="page-dots">
                    <span>...</span>
                </li>
            @elseif ($page > $paginator->currentPage() + 1 && $page < $paginator->lastPage() - 2 && !$show_dots_end)
                <!-- Reticências para páginas posteriores não exibidas -->
                @php $show_dots_end = true; @endphp
                <li class="disabled" id="page-dots">
                    <span>...</span>
                </li>
            @endif
        @endfor

        <!-- Link para a página seguinte -->
        <li class="{{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a href="{{ $paginator->nextPageUrl() }}">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</nav>

