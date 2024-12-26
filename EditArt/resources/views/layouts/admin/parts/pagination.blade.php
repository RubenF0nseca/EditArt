<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $paginator->onFirstPage() }}">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>
        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            <li>
                <a href="{{ $paginator->url($page) }}" class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    {{ $page }}
                </a>
            </li>
        @endfor
        <li class="{{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a href="{{ $paginator->nextPageUrl() }}">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</nav>

