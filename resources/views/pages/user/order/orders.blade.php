@extends('layouts')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="breadcrumbs">
        <ol class="breadcrumb" style="margin:0;">
          <li><a href="/">Home</a></li>
          <li class="active">Đơn hàng</li>
        </ol>
      </div>
    </div>
    @if (count($orders) > 0)
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="cart_menu">
                <th>#</th>
                <th>Họ tên</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Tiền hàng</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
                <th>Chi tiết</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $key => $order)
                <tr>
                  <th>{{ ++$key }}</th>
                  <td>{{ $order->shipping->full_name }}</td>
                  <td>{{ $order->shipping->phone }}</td>
                  <td>{{ $order->shipping->city }}</td>
                  <td>{{ formatCurrent($order->total) }}</td>
                  <td>
                    @if ($order->status == 'ordered')
                      <b class="text-info">Đang xử lý</b>
                    @elseif($order->status == 'delivered')
                      <b class="text-success">Thành công</b>
                    @else
                      <b class="text-danger">Đã hủy</b>
                    @endif
                  </td>
                  <td>
                    @if ($order->status == 'ordered')
                      {{ $order->created_at }}
                    @elseif($order->status == 'delivered')
                      {{ $order->delivered_date }}
                    @else
                      {{ $order->canceled_date }}
                    @endif
                  </td>
                  <td>
                    <a class="btn btn-info btn-default" href="{{ route('user.order.details', $order->id) }}">Chi
                      tiết</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="" style="display: flex;justify-content: center; margin-top: 5rem;">
        {{ $orders->links('pagination') }}
      </div>
    @else
      <div class="text-center" style="padding: 2rem 0 30vh;">
        <i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i>
        <h3>Không tìm thấy đơn hàng !</h3>
        <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
      </div>
    @endif
  </div>
@endsection
