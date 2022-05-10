@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h4 class="mt-4">Phí vận chuyển</h4>
    <div class="card my-4">
      <div class="card-header">
        <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-primary float-end">Thêm slider</button>
      </div>
      <div class="card-body">

        @if (count($sliders) > 0)
          <table class="table table-bordered ">
            <thead class="bg-success text-white">
              <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Tiêu đề phụ</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Link</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sliders as $key => $slider)
                <tr>
                  <th>{{ ++$key }}</th>
                  <td>{{ $slider->title }}</td>
                  <td>{{ $slider->sub_title }}</td>
                  <td>{{ $slider->desc }}</td>
                  <td><img width="100" height="100" src="{{ asset('images/' . $slider->image) }}"
                      alt="{{ $slider->title }}"></td>
                  <td>{{ $slider->price }}</td>
                  <td>{{ $slider->link }}</td>
                  <td>
                    @if ($slider->status)
                      <i class="fa fa-eye text-success"></i>
                    @else
                      <i class="fa fa-eye-slash text-danger"></i>
                    @endif
                  </td>
                  <td class="d-flex gap-1" style="height:100%;">
                    <button type="button" class="btn btn-info edit_slider" data-type="edit" data-id="{{ $slider->id }}">
                      Sửa
                    </button>
                    <button type="button" class="btn btn-danger delete_slider" data-type="delete"
                      data-id="{{ $slider->id }}">
                      Xóa
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $sliders->links('pages.admin.pagination') }}
        @else
          <h3>Chưa có slider !</h3>
        @endif


      </div>
    </div>
  </div>

  @include('pages.admin.slider.add')
@endsection
@push('script')
  <script>
    $(document).ready(function() {
      $(".edit_slider,.delete_slider").click(function(e) {

        let id = $(this).data("id");
        let type = $(this).data("type");
        let url = type === 'edit' ? "{{ route('admin.edit.slider') }}" :
          "{{ route('admin.delete.slider') }}";
        $(`#modalEdit${id}`).remove();
        $(`#modalDelete${id}`).remove();

        $.ajax({
          url,
          method: "POST",
          data: {
            id,
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            $(".content").after(res);
            type == "edit" ? $(`#modalEdit${id}`).modal("show") : $(`#modalDelete${id}`).modal("show");
          }
        })
      })

      //   $(".delete_slider").click(function(e) {

      //     let id = e.target.dataset.id;
      //     let url = `{{ url('/admin/delete-slider/${id}') }}`;
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


      // $(".add-to-cart,.add-to-wishlist").click(function(e) {
      //   let id = $(this).data("id");
      //   let type = $(this).data("type");
      //   let name = $(this).data("name");
      //   let price = $(this).data("price");
      //   let qty = $(this).data("qty") || 1;
      //   let url = type === 'cart' ? "{{ route('cart.store') }}" : "{{ route('wishlist.store') }}";
      //   $.ajax({
      //     url,
      //     method: "POST",
      //     data: {
      //       id,
      //       name,
      //       price,
      //       qty,
      //       _token: "{{ csrf_token() }}"
      //     },
      //     success: function(res) {

      //       $(`.${type}-count`).html(res)

      //       const Toast = Swal.mixin({
      //         toast: true,
      //         position: 'bottom-end',
      //         showConfirmButton: false,
      //         timer: 2000,
      //         timerProgressBar: true,
      //       })

      //       Toast.fire({
      //         icon: 'success',
      //         title: 'Thêm thành công',
      //         padding: '1em',
      //         showCloseButton: true
      //       })

      //     }
      //   })
      // })
    });
  </script>
@endpush
