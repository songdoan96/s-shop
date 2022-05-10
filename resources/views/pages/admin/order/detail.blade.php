@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h3 class="mt-4">Chi tiết đơn hàng</h3>
    <div class="card my-4">
      <div class="card-header">
        Chi tiết đơn hàng
        <div class="float-end">
          {{-- <a href="{{ route('admin.orders.send.mail') }}" class="btn btn-info ">Gửi
                        mail</a> --}}
          <a href="{{ route('admin.orders') }}" class="btn btn-primary">Đơn hàng</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
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


  <div class="container-fluid px-4 content">
    <div class="card my-4">
      <div class="card-header">
        Sản phẩm
      </div>
      <div class="card-body">

        <table class="table table-bordered">
          <thead>
            <tr class="cart_menu">
              <td>Hình ảnh</td>
              <td class="image">Sản phẩm</td>
              <td class="price">Giá</td>
              <td class="quantity">Số lượng</td>
              <td class="total">Thành tiền</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->orderItems as $item)
              <tr>
                <td class="cart_product">
                  <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                    width="50">
                </td>
                <td class="cart_description">
                  <h6>{{ $item->product->name }}</h6>
                </td>
                <td class="cart_price">
                  <p>{{ formatCurrent($item->product->price) }}</p>
                </td>
                <td class="cart_quantity">
                  <div class="cart_quantity_button">

                    <p>{{ $item->quantity }}</p>
                  </div>
                </td>
                <td class="cart_total">
                  <p class="cart_total_price">{{ formatCurrent($item->price * $item->quantity) }}</p>
                </td>

              </tr>
            @endforeach

          </tbody>
        </table>

      </div>
    </div>
  </div>
  <div class="container-fluid px-4 content">
    <div class="card my-4">
      <div class="card-header">
        Sản phẩm
      </div>
      <div class="card-body">

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
  <div class="container-fluid px-4 content">
    <div class="card my-4">
      <div class="card-header">
        Địa chỉ giao hàng
      </div>
      <div class="card-body">
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
@endsection
