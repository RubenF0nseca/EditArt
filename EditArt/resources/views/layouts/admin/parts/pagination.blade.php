<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }} ">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $paginator->onFirstPage() }}">Previous</a>
        </li>
        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
            </li>
        @endfor

        <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
