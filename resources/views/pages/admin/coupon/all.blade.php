@extends('admin')

@section('admin_content')

  <div class="container-fluid px-4 content">
    <h3 class="mt-4">Mã giảm giá</h3>
    <div class="card my-4">
      <div class="card-header">
        Mã giảm giá
        <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-primary float-end">Thêm mã</button>
      </div>
      <div class="card-body">
        @if (count($coupons) > 0)
          <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
              <tr>
                <th>#</th>
                <th>Mã</th>
                <th>Loại</th>
                <th>Giảm</th>
                <th>Tối đa</th>
                <th>Số lượng</th>
                <th>Ngày hết hạn</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($coupons as $key => $coupon)
                <tr>
                  <th>{{ ++$key }}</th>
                  <td>{{ $coupon->code }}</td>
                  <td>{{ $coupon->type === 'fixed' ? 'Trừ thẳng' : 'Phần trăm' }}</td>
                  <td>{{ $coupon->value }}</td>
                  <td>{{ formatCurrent($coupon->max_value) }}</td>
                  <td>{{ $coupon->quantity }}</td>
                  <td>{{ $coupon->exp_date }}</td>
                  <td>
                    @if ($coupon->status)
                      <i class="fa fa-eye text-success"></i>
                    @else
                      <i class="fa fa-eye-slash text-danger"></i>
                    @endif
                  </td>
                  <td class="d-flex gap-1">
                    <button type="button" class="btn btn-info edit_coupon" data-id="{{ $coupon->id }}">
                      Sửa
                    </button>
                    <button type="button" class="btn btn-danger delete_coupon" data-id="{{ $coupon->id }}">
                      Xóa
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {{ $coupons->links('pages.admin.pagination') }}
        @else
          <h3>Không tìm thấy mã giảm !</h3>
        @endif

      </div>
    </div>
  </div>

  @include('pages.admin.coupon.add')
@endsection
@push('script')
  <script>
    $(document).ready(function() {


      // Edit
      $(".edit_coupon").click(function(e) {
        let id = e.target.dataset.id;
        let url = `{{ url('/admin/edit-coupon/${id}') }}`;
        $(`#modalEdit${id}`).remove();
        $.ajax({
          url,
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            $(".content").after(res);
            $(`#modalEdit${id}`).modal("show");
          }
        })
      })

      $(".delete_coupon").click(function(e) {
        let id = e.target.dataset.id;
        let url = `{{ url('/admin/delete-coupon/${id}') }}`;
        $(`#modalDelete${id}`).remove();
        $.ajax({
          url,
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            $(".content").after(res);
            $(`#modalDelete${id}`).modal("show");
          }
        })
      })
    });
  </script>
@endpush
