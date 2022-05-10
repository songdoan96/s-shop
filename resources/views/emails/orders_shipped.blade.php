<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>S shop</title>
  <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</head>

<body>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('backend/js/scripts.js') }}"></script>
</body>

</html>
