@extends('layouts')
@section('content')
  <div class="col-sm-12">
    @if (Cart::instance('wishlist')->count() > 0)
      <h2 class="title text-center">Sản phẩm yêu thích</h2>
      @foreach (Cart::instance('wishlist')->content() as $row)
        <div class="col-sm-3">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <a href="{{ route('product.details', $row->model->slug) }}">
                  <img src="{{ asset('images/' . $row->model->image) }}" alt="{{ $row->name }}" height="200">
                </a>
                <h2>{{ number_format($row->price, 0, ',', '.') }}</h2>
                <p style="height:60px;">
                  <a href="{{ route('product.details', $row->model->slug) }}">
                    {{ $row->name }}
                  </a>
                </p>
                <button data-rowid={{ $row->rowId }} class="btn btn-default add-to-cart move-to-cart"><i
                    class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>

              </div>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <div class="text-center" style="padding: 2rem 0 30vh;">
        <i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i>
        <h3>Danh mục yêu thích trống</h3>
        <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
      </div>
    @endif

  </div>
@endsection
@push('script')
  <script>
    $(document).ready(function() {
      $(".move-to-cart").click(function(e) {
        let rowId = $(this).data('rowid')
        let url = "{{ route('wishlist.move.cart') }}"
        $.ajax({
          url,
          method: "POST",
          data: {
            rowId,
            _token: "{{ csrf_token() }}"
          },
          success: function(res) {
            location.reload();
          }
        })
      })

    })
  </script>
@endpush
