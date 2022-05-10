@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h4 class="mt-4">Tài khoản</h4>
    <div class="card my-4">
      <div class="card-header">
        Tài khoản người dùng
      </div>
      <div class="card-body">

        @if (count($users))
          <table class="table table-bordered table-striped">
            <thead class="bg-success text-white">
              <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Quyền hạn</th>
                <th>Loại tài khoản</th>
                <th>Ảnh</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $user)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}
                    <a href="{{ route('admin.edit.role', [$user->id]) }}"><i class="fas fa-exchange-alt ms-2"></i></a>
                  </td>
                  <td>
                    @if (!$user->provider)
                      Đăng ký
                    @else
                      {{ $user->provider }}
                    @endif

                  </td>
                  <td><img width="60" src="{{ $user->avatar }}" alt=""></td>

                </tr>
              @endforeach
            </tbody>
          </table>
          {{-- {{ $users->links('pages.admin.pagination') }} --}}
        @else
          <h3>Chưa có phí vận chuyển !</h3>
        @endif


      </div>
    </div>
  </div>


@endsection
@push('script')
  <script>
    $(document).ready(function() {
      // Edit
      //   $(".edit_fee").click(function(e) {
      //     let id = e.target.dataset.id;
      //     let url = `{{ url('/admin/edit-fee/${id}') }}`;
      //     $(`#modalEdit${id}`).remove();
      //     $.ajax({
      //       url,
      //       method: "POST",
      //       data: {
      //         "_token": "{{ csrf_token() }}",
      //       },
      //       success: function(res) {
      //         $(".content").after(res);
      //         $(`#modalEdit${id}`).modal("show");
      //       }
      //     })
      //   })

      //   $(".delete_fee").click(function(e) {

      //     let id = e.target.dataset.id;
      //     let url = `{{ url('/admin/delete-fee/${id}') }}`;
      //     $(`#modalDelete${id}`).remove();
      //     $.ajax({
      //       url,
      //       method: "POST",
      //       data: {
      //         "_token": "{{ csrf_token() }}",
      //       },
      //       success: function(res) {
      //         $(".content").after(res);
      //         $(`#modalDelete${id}`).modal("show");
      //       }
      //     })
      //   })
    });
  </script>
@endpush
