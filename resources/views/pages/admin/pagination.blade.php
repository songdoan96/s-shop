<div class="dataTable-bottom">
  <div class="dataTable-info">

    {!! __('Hiển thị từ') !!}
    @if ($paginator->firstItem())
      <span class="font-medium">{{ $paginator->firstItem() }}</span>
      {!! __('-') !!}
      <span class="font-medium">{{ $paginator->lastItem() }}</span>
    @else
      {{ $paginator->count() }}
    @endif
    {!! __('trên') !!}
    <span class="font-medium">{{ $paginator->total() }}</span>
    {{-- {!! __('kết quả') !!} --}}

  </div>
  @if ($paginator->hasPages())
    <nav class="dataTable-pagination">
      <ul class="dataTable-pagination-list">

        @if (!$paginator->onFirstPage())
          <li class="pager">
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
              @if ($page == $paginator->currentPage())
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
          <li class="pager">
            <a href=" {{ $paginator->nextPageUrl() }}">
              <i class="fa fa-chevron-right"></i>
            </a>
          </li>
        @endif
      </ul>
    </nav>
  @endif
</div>
