@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h4 class="mt-4">Sản phẩm</h4>
    <div class="card my-4">
      <div class="card-header">
        <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-primary float-end">Thêm sản
          phẩm</button>
      </div>
      <div class="card-body">
        {{-- @include('sweetalert::alert') --}}

        @if (session('message'))
          <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <table class="table table-bordered table-striped">
          <thead class="bg-primary text-white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tên</th>
              {{-- <th scope="col">Mô tả</th> --}}
              <th>Danh mục</th>
              <th>Thương hiệu</th>
              <th>Ảnh</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Tùy chọn</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $key => $product)
              <tr>
                <th>{{ ++$key }}</th>
                <td>{{ $product->name }}</td>
                {{-- <td>{{ $product->desc }}</td> --}}
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->brand->name }}</td>
                <td><img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="100"></td>
                <td>
                  @if ($product->status)
                    <i class="fa fa-eye text-success"></i>
                  @else
                    <i class="fa fa-eye-slash text-danger"></i>
                  @endif
                </td>
                <td class="d-flex gap-1">
                  <button type="button" class="btn btn-info edit_product" data-id="{{ $product->id }}">
                    Sửa
                  </button>
                  <button type="button" class="btn btn-danger delete_product" data-id="{{ $product->id }}">
                    Xóa
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $products->links('pages.admin.pagination') }}

      </div>
    </div>
  </div>

  @include('pages.admin.product.add')
@endsection
@push('script')
  <script>
    $(document).ready(function() {
      // Edit
      $(".edit_product").click(function(e) {
        let id = e.target.dataset.id;
        let url = `{{ url('/admin/edit-product/${id}') }}`;
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

      $(".delete_product").click(function(e) {

        let id = e.target.dataset.id;
        let url = `{{ url('/admin/delete-product/${id}') }}`;
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
