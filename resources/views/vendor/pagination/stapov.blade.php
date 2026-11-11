@if ($paginator->hasPages())
<nav style="display:flex;gap:.3rem;flex-wrap:wrap;justify-content:center" role="navigation" aria-label="Halaman">
  @if ($paginator->onFirstPage())<span class="btn btn-line btn-sm" style="opacity:.4">‹</span>
  @else<a class="btn btn-line btn-sm" href="{{ $paginator->previousPageUrl() }}">‹</a>@endif

  @foreach ($elements as $element)
    @if (is_string($element))<span class="btn btn-sm">{{ $element }}</span>@endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())<span class="btn btn-primary btn-sm">{{ $page }}</span>
        @else<a class="btn btn-line btn-sm" href="{{ $url }}">{{ $page }}</a>@endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())<a class="btn btn-line btn-sm" href="{{ $paginator->nextPageUrl() }}">›</a>
  @else<span class="btn btn-line btn-sm" style="opacity:.4">›</span>@endif
</nav>
@endif
