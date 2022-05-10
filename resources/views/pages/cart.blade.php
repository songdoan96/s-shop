@extends('layouts')
@section('content')
  <div class="col-sm-12">
    @if (Cart::instance('cart')->count() > 0)
      <section id="cart_items">
        <div class="container">
          <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
          </div>
          <div class="table-responsive cart_info">
            <table class="table table-condensed">
              <thead>
                <tr class="cart_menu">
                  <td class="image">Item</td>
                  <td class="description"></td>
                  <td class="price">Price</td>
                  <td class="quantity">Quantity</td>
                  <td class="total">Total</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                @foreach (Cart::instance('cart')->content() as $key => $row)
                  <tr>
                    <td class="cart_product">
                      <a href="{{ route('product.details', $row->model->slug) }}"><img width="70"
                          src="{{ asset('images/' . $row->model->image) }}" alt=""></a>
                    </td>
                    <td class="cart_description">
                      <h4><a href="{{ route('product.details', $row->model->slug) }}">{{ $row->name }}</a></h4>
                      <p>Web ID: {{ $row->id }}</p>
                    </td>
                    <td class="cart_price">
                      <p>{{ formatCurrent($row->price) }}</p>
                    </td>
                    <td class="cart_quantity">
                      <div class="cart_quantity_button">
                        <a class="cart_quantity_down" href="#" data-id="{{ $row->rowId }}"> - </a>
                        <input class="cart_quantity_input" type="text" value="{{ $row->qty }}" autocomplete="off" size="2" disabled>
                        <a class="cart_quantity_up" href="#" data-id="{{ $row->rowId }}"> + </a>
                      </div>
                    </td>
                    <td class="cart_total">
                      <p class="cart_total_price">{{ formatCurrent($row->subtotal()) }}</p>
                    </td>
                    <td class="cart_delete">
                      <a class="cart_quantity_delete" href="#" data-id="{{ $row->rowId }}">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <p style="font-size: 3rem;font-weight: 500;">Tổng:</p>
                  </td>
                  <td>
                    <p class="cart_total_price">{{ formatCurrent(Cart::instance('cart')->subtotal()) }}</p>
                  </td>
                </tr>
                <tr>
                  <td colspan="5"><a href="{{ route('checkout') }}" class="btn btn-primary btn-lg pull-right">Thanh
                      toán</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    @else
      <div class="text-center" style="padding: 2rem 0 30vh;">
        <i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i>
        <h3>Giỏ hàng trống</h3>
        <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
      </div>
    @endif

  </div>

@endsection
@push('script')
  <script>
    $(document).ready(function() {

      $(".cart_quantity_up,.cart_quantity_down").click(function(e) {
        e.preventDefault();
        let rowId = e.target.dataset.id;
        let btn = e.target.className === "cart_quantity_up" ? true : false;
        let url = btn ? "{{ route('cart.increaseQty') }}" : "{{ route('cart.decreaseQty') }}"
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

      $(".cart_quantity_delete").click(function(e) {
        e.preventDefault();
        let rowId = e.target.dataset.id;
        let url = "{{ route('cart.removeItem') }}"
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
