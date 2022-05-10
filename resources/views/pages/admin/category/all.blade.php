@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h3 class="mt-4">Danh mục</h3>


    <div class="card my-4">
      <div class="card-header">
        Danh mục

        <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-primary float-end">Thêm danh
          mục</button>

      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead class="bg-primary text-white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tên</th>
              <th scope="col">Mô tả</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Tùy chọn</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $key => $category)
              <tr>
                <th>{{ ++$key }}</th>
                <td>{{ $category->name }}</td>
                <td>{{ $category->desc }}</td>
                <td>
                  @if ($category->status)
                    <i class="fa fa-eye text-success"></i>
                  @else
                    <i class="fa fa-eye-slash text-danger"></i>
                  @endif
                </td>
                <td class="d-flex gap-1">


                  <button type="button" class="btn btn-info edit_category" data-id="{{ $category->id }}">
                    Sửa
                  </button>
                  <button type="button" class="btn btn-danger delete_category" data-id="{{ $category->id }}">
                    Xóa
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @include('pages.admin.category.add')
@endsection


@push('script')
  <script>
    $(document).ready(function() {
      // Edit
      $(".edit_category").click(function(e) {
        let id = e.target.dataset.id;
        let url = `{{ url('/admin/edit-category/${id}') }}`;
        $(`#modalEdit${id}`).remove();
        $.ajax({
          url,
          method: "GET",
          success: function(res) {
            $(".content").after(res);
            $(`#modalEdit${id}`).modal("show");
          }
        })
      })

      $(".delete_category").click(function(e) {

        let id = e.target.dataset.id;
        let url = `{{ url('/admin/delete-category/${id}') }}`;
        $(`#modalDelete${id}`).remove();
        $.ajax({
          url,
          method: "GET",
          success: function(res) {
            $(".content").after(res);
            $(`#modalDelete${id}`).modal("show");
          }
        })
      })
    });
  </script>
@endpush
