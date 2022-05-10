{{-- @extends('admin')
@section('admin_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh mục</h1>


        <div class="card mb-4">
            <div class="card-header">
                Thêm danh mục
                <a href="{{ route('admin_categories') }}" class="btn btn-primary float-end">Danh mục</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin_store_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Mô tả</label>
                                <textarea type="text" class="form-control" name="desc" id="desc" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Trạng thái</label>
                                <select class="form-select" name="status" required>
                                    <option disabled>=== Chọn ===</option>
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>

        </div>
    </div>
@endsection --}}

<form action="{{ route('admin_store_category') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Mô tả</label>
                                <textarea type="text" class="form-control" name="desc" id="desc" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Trạng thái</label>
                                <select class="form-select" name="status" required>
                                    <option disabled>=== Chọn ===</option>
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                </div>
            </div>
        </div>
    </div>
</form>
