<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    @charset "UTF-8";

    :root {
      --bs-blue: #0d6efd;
      --bs-indigo: #6610f2;
      --bs-purple: #6f42c1;
      --bs-pink: #d63384;
      --bs-red: #dc3545;
      --bs-orange: #fd7e14;
      --bs-yellow: #ffc107;
      --bs-green: #198754;
      --bs-teal: #20c997;
      --bs-cyan: #0dcaf0;
      --bs-white: #fff;
      --bs-gray: #6c757d;
      --bs-gray-dark: #343a40;
      --bs-gray-100: #f8f9fa;
      --bs-gray-200: #e9ecef;
      --bs-gray-300: #dee2e6;
      --bs-gray-400: #ced4da;
      --bs-gray-500: #adb5bd;
      --bs-gray-600: #6c757d;
      --bs-gray-700: #495057;
      --bs-gray-800: #343a40;
      --bs-gray-900: #212529;
      --bs-primary: #0d6efd;
      --bs-secondary: #6c757d;
      --bs-success: #198754;
      --bs-info: #0dcaf0;
      --bs-warning: #ffc107;
      --bs-danger: #dc3545;
      --bs-light: #f8f9fa;
      --bs-dark: #212529;
      --bs-primary-rgb: 13, 110, 253;
      --bs-secondary-rgb: 108, 117, 125;
      --bs-success-rgb: 25, 135, 84;
      --bs-info-rgb: 13, 202, 240;
      --bs-warning-rgb: 255, 193, 7;
      --bs-danger-rgb: 220, 53, 69;
      --bs-light-rgb: 248, 249, 250;
      --bs-dark-rgb: 33, 37, 41;
      --bs-white-rgb: 255, 255, 255;
      --bs-black-rgb: 0, 0, 0;
      --bs-body-color-rgb: 33, 37, 41;
      --bs-body-bg-rgb: 255, 255, 255;
      --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
      --bs-body-font-family: var(--bs-font-sans-serif);
      --bs-body-font-size: .5rem;
      --bs-body-font-weight: 400;
      --bs-body-line-height: 1.5;
      --bs-body-color: #212529;
      --bs-body-bg: #fff;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }



    body {
      margin: 0;
      font-size: .8rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      font-family: 'DejaVu Sans', sans-serif;
    }

    .container,
    .container-fluid,
    .container-xxl,
    .container-xl,
    .container-lg,
    .container-md,
    .container-sm {
      width: 100%;
      padding-right: 0.5rem;
      padding-left: 0.5rem;
      margin-right: auto;
      margin-left: auto;
    }

    .d-flex {
      display: flex !important;
    }

    .justify-content-between {
      justify-content: space-between !important;
    }

    .align-items-center {
      align-items: center !important;
    }

    .my-4 {
      margin-top: 1.5rem !important;
      margin-bottom: 1.5rem !important;
    }

    ol,
    ul {
      padding-left: 1.5rem;
    }

    ol,
    ul,
    dl {
      margin-top: 0;
      margin-bottom: .5rem;
    }

    .list-group {
      display: flex;
      flex-direction: column;
      padding-left: 0;
      margin-bottom: 0;
      border-radius: 0.25rem;
    }

    .list-group-item {
      position: relative;
      display: block;
      padding: 0.5rem .5rem;
      color: #212529;
      text-decoration: none;
      background-color: #fff;
      border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .list-group-item:first-child {
      border-top-left-radius: inherit;
      border-top-right-radius: inherit;
    }

    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid rgba(0, 0, 0, 0.125);
      border-radius: 0.25rem;
    }

    .card-header {
      padding: 0.5rem .5rem;
      margin-bottom: 0;
      background-color: rgba(0, 0, 0, 0.03);
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header:first-child {
      border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }

    .card-body {
      flex: 1 1 auto;
      padding: .5rem .5rem;
    }

    table {
      caption-side: bottom;
      border-collapse: collapse;
    }

    .table,
    .dataTable-table {
      width: 100%;
      margin-bottom: .5rem;
      color: #212529;
      vertical-align: top;
      border-color: #dee2e6;
    }

    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
      border-color: inherit;
      border-style: solid;
      border-width: 0;
    }

    .table>tbody,
    .dataTable-table>tbody {
      vertical-align: inherit;
    }

    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
      border-color: inherit;
      border-style: solid;
      border-width: 0;
    }

    .table>thead,
    .dataTable-table>thead {
      vertical-align: bottom;
    }

    .table-bordered> :not(caption)>*,
    .dataTable-table> :not(caption)>* {
      border-width: 1px 0;
    }


    .table> :not(caption)>*>*,
    .dataTable-table> :not(caption)>*>* {
      padding: 0.5rem 0.5rem;
      background-color: transparent;
      border-bottom-width: 1px;
      box-shadow: inset 0 0 0 9999px transparent;
    }

    .table-bordered> :not(caption)>*>*,
    .dataTable-table> :not(caption)>*>* {
      border-width: 0 1px;
    }

  </style>

</head>

<body>

  <div class="container-fluid px-4 content">
    <h3 class="mt-4">Chi tiết đơn hàng</h3>
    <div class="card my-4">
      <div class="card-header">
        Chi tiết đơn hàng
        <div class="float-end">


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
            <tr class="cart_menu" >
              <td class="image">Sản phẩm</td>
              <td class="price">Giá</td>
              <td class="quantity">Số lượng</td>
              <td class="total">Thành tiền</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->orderItems as $key => $item)
              <tr>
                <td>{{ $key }}</td>
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
            <span style="float: right;">{{ formatCurrent($order->cart_subtotal) }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">Áp mã
            ({{ $order->coupon_code }})
            <span style="float: right;">{{ formatCurrent($order->discount) }}</span>
          </li>

          <li class="list-group-item d-flex justify-content-between align-items-center">Phí ship
            <span style="float: right;">{{ formatCurrent($order->fee_ship) }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">Tổng cộng
            <span style="float: right;"> {{ formatCurrent($order->total) }}</span>
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
</body>

</html>
