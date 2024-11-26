<nav aria-label="...">
    <ul class="pagination justify-content-center">
        <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }} ">
            <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $books->onFirstPage() }}">Previous</a>
        </li>
        @for ($page = 1; $page <= $books->lastPage(); $page++)
            <li class="page-item {{ $page == $books->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $books->url($page) }}">{{ $page }}</a>
            </li>
        @endfor

        <li class="page-item {{ $books->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $books->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
