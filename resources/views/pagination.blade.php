@if ($paginator->hasPages())
  <ul class="pagination">
    @if (!$paginator->onFirstPage())
      <li>
        <a href="{{ $paginator->previousPageUrl() }}">
          <i class="fa fa-chevron-left"></i>
        </a>
      </li>
    @endif

    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <li>
          <p> {{ $element }} </p>
        </li>
      @endif

      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage() && $paginator->total() != '1')
            <li class="active">
              <a href="#" data-page="{{ $page }}">{{ $page }}</a>
            </li>
          @else
            <li class="">
              <a href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li>
        <a href=" {{ $paginator->nextPageUrl() }}">
          <i class="fa fa-chevron-right"></i>
        </a>
      </li>
    @endif
  </ul>
@endif
