@extends('layouts')
@section('content')
  <div>
    <div class="container">
      <div class="row">

        <div class="panel panel-default">
          <div class="panel-heading d-flex justify-content-between align-items-center">
            <ol class="breadcrumb m-0">
              <li><a href="#">Trang chủ</a></li>
              <li class="active">Chi tiết đơn hàng</li>
            </ol>
            <div class="">
              @if ($order->status == 'ordered')
                <button id="cancelOrder" data-id="{{ $order->id }}" class="btn btn-warning mx-4">Hủy đơn</button>
              @endif
              <a href="{{ route('user.orders') }}" class="btn btn-success pull-right ">Đơn hàng</a>
            </div>
          </div>
          <div class="panel-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered">
                <tr>
                  <th>ID</th>
                  <td>{{ $order->id }}</td>
                  <th>Ngày mua</th>
                  <td>{{ $order->created_at }}</td>
                  <th>Trạng thái</th>
                  <td>
                    @if ($order->status == 'ordered')
                      Đang chờ xử lý
                    @elseif($order->status == 'delivered')
                      Thành công
                    @else
                      Đã hủy
                    @endif
                  </td>
                  @if ($order->status == 'delivered')
                    <th>Ngày giao</th>
                    <td>{{ $order->delivered_date }}</td>
                  @elseif($order->status == 'canceled')
                    <th>Ngày hủy</th>
                    <td>{{ $order->canceled_date }}</td>
                  @endif

                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>Sản phẩm</h5>
          </div>
          <div class="panel-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr class="">
                    <td>Hình ảnh</td>
                    <td>Sản phẩm</td>
                    <td>Giá</td>
                    <td>Số lượng</td>
                    <td>Thành tiền</td>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->orderItems as $item)
                    <tr>
                      <td>
                        <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                          width="50">
                      </td>
                      <td>
                        <h4>{{ $item->product->name }}
                        </h4>
                      </td>
                      <td>
                        <p>{{ formatCurrent($item->product->price) }}</p>
                      </td>
                      <td>
                        <div>

                          <p>X {{ $item->quantity }}</p>
                        </div>
                      </td>
                      <td>
                        <p class="cart_total_price">{{ formatCurrent($item->price * $item->quantity) }}</p>
                      </td>
                      @if ($order->status == 'delivered' && $item->r_status == 0)
                        <td>
                          {{-- <a href="{{ route('user.reviews', ['order_item_id' => $item->id]) }}"
                            class="btn btn-primary m-0">Đánh giá</a> --}}

                          <form action="{{ route('user.reviews') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                            <button class="btn btn-primary m-0" type="submit">Đánh giá</button>
                          </form>
                        </td>
                      @endif

                    </tr>
                  @endforeach

                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>Thành tiền</h5>
          </div>
          <div class="panel-body">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">Giỏ hàng
                <span>{{ formatCurrent($order->cart_subtotal) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">Áp mã
                ({{ $order->coupon_code }})
                <span>{{ formatCurrent($order->discount) }}</span>
              </li>
              {{-- <li class="list-group-item d-flex justify-content-between align-items-center">Thuế
                    <span>{{ formatCurrent($order->tax) }}</span>
                  </li> --}}
              <li class="list-group-item d-flex justify-content-between align-items-center">Phí ship
                <span>{{ formatCurrent($order->fee_ship) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">Tổng cộng
                <span>{{ formatCurrent($order->total) }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>Địa chỉ giao hàng</h5>

          </div>
          <div class="panel-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered">
                <tr>
                  <th>Họ tên</th>
                  <td>{{ $order->shipping->full_name }}</td>
                  <th>Email</th>
                  <td>{{ $order->shipping->email }}</td>
                </tr>
                <tr>
                  <th>SĐT</th>
                  <td>{{ $order->shipping->phone }}</td>
                  <th>Xã</th>
                  <td>{{ $order->shipping->ward }}</td>
                </tr>
                <tr>
                  <th>Huyện</th>
                  <td>{{ $order->shipping->province }}</td>
                  <th>Tỉnh</th>
                  <td>{{ $order->shipping->city }}</td>
                </tr>
              </table>
              <p><b>Ghi chú</b>: <i>{{ $order->shipping->note }}</i></p>


            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection



@push('script')
  <script>
    $(document).ready(function() {
      // Edit
      $("#cancelOrder").click(function(e) {
        // e.preventDefault();
        let order_id = e.target.dataset.id;
        let url = `{{ route('user.order.cancel') }}`;
        $.ajax({
          url,
          method: "POST",
          data: {
            order_id,
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            location.reload();
          }
        })
      })

    });
  </script>
@endpush
