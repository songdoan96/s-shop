@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h3 class="mt-4">Đơn hàng</h3>
    <div class="card my-4">
      <div class="card-header">
        Đơn hàng
      </div>
      <div class="card-body">

        @if (count($orders) > 0)
          <table class="table table-bordered table-striped">
            <thead class="bg-success text-white">
              <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Tiền hàng</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
                <th>Chi tiết</th>
                <th>Trạng thái</th>
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
                      Yêu cầu
                    @elseif($order->status == 'delivered')
                      Thành công
                    @else
                      Hủy
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
                    <a class="btn btn-info btn-sm" href="{{ route('admin.order.details', $order->id) }}">Chi
                      tiết</a>
                  </td>
                  <td>

                    @if ($order->status == 'ordered')
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="order_actions"
                          data-bs-toggle="dropdown" aria-expanded="false">
                          Trạng thái
                        </button>
                        <ul class="dropdown-menu" data-id="{{ $order->id }}" aria-labelledby="order_actions">
                          <li><button class="dropdown-item" id="delivered" data-id="{{ $order->id }}">Thành
                              công</button></li>
                          <li><a class="dropdown-item" id="canceled" data-id="{{ $order->id }}">Hủy</a></li>
                        </ul>
                      </div>
                    @endif
                    @if ($order->status == 'delivered')
                      <a href="{{ route('admin.order.print', [$order->id]) }}" target="_blank">Xuất PDF</a>
                    @endif
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $orders->links('pages.admin.pagination') }}
        @else
          <h3>Không tìm thấy đơn hàng !</h3>
        @endif
      </div>
    </div>
  </div>

@endsection
@push('script')
  <script>
    $(document).ready(function() {
      // Edit
      $("#delivered,#canceled").click(function(e) {
        // e.preventDefault();
        let id = e.target.dataset.id;
        let status = this.id;
        let url = `{{ route('admin.order.edit.status') }}`;
        $.ajax({
          url,
          method: "POST",
          data: {
            id,
            status,
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
