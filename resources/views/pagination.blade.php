@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Anterior Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" style="background-color: #81bb26; color: white;">
                    <i class="fas fa-arrow-left"></i> {{-- Flecha hacia la izquierda --}}
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" style="background-color: #81bb26; color: white;">
                    <i class="fas fa-arrow-left"></i> {{-- Flecha hacia la izquierda --}}
                </a>
            </li>
        @endif

        {{-- Números de página --}}
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Siguiente Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" style="background-color: #81bb26; color: white;">
                    <i class="fas fa-arrow-right"></i> {{-- Flecha hacia la derecha --}}
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" style="background-color: #81bb26; color: white;">
                    <i class="fas fa-arrow-right"></i> {{-- Flecha hacia la derecha --}}
                </span>
            </li>
        @endif
    </ul>
@endif



<style>
    .pagination {
    display: flex;
    list-style: none;
    padding: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a {
    text-decoration: none;
    color: #333; /* Color de enlace */
    background: #f5f5f5; /* Color de fondo */
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    display: block;
}

.pagination li.disabled span {
    color: #777; /* Color de texto deshabilitado */
}

.custom-pagination-link {
    background-color: #81bb26;
    color: white; /* Cambia el color del texto si es necesario */
}

.custom-pagination-link:hover {
    background-color: #5c9120; /* Cambia el color de fondo al pasar el cursor si es necesario */
}
</style>