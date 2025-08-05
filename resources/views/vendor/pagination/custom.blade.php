@if ($paginator->hasPages())
<div class="pagination">
@if ($paginator->onFirstPage())
<span class="page disabled">&laquo; Anterior</span>
@else
<a href="{{ $paginator->previousPageUrl() }}" class="page">&laquo; Anterior</a>
@endif


@foreach ($elements as $element)
@if (is_string(value: $element))
<span class="page disabled">{{ $element }}</span>
@endif

@if (is_array(value: $element))
@foreach ($element as $page => $url)
@if ($page == $paginator->currentPage())
<span class="page active">{{ $page }}</span>
@else
<a href="{{ $url }}" class="page">{{ $page }}</a>
@endif
@endforeach
@endif
@endforeach


@if ($paginator->hasMorePages())
<a href="{{ $paginator->nextPageUrl() }}" class="page">Siguiente &raquo; </a>
@else
<span class="page disabled">Siguiente &raquo; </span>
@endif
</div>
@endif