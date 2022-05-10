<div class="modal fade" id="modalEdit{{ $category->id }}" tabindex="-1" aria-labelledby="modalEditLabel"
  aria-hidden="true">
  <form action="{{ route('admin_update_category', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <div class="modal-dialog" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Xóa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input value={{ $category->name }} type="text" class="form-control" name="name" id="name" required>
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label">Mô tả</label>
                <textarea type="text" class="form-control" name="desc" id="desc" required>{{ $category->desc }}</textarea>
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Trạng thái</label>
                <select value={{ $category->status }} class="form-select" name="status" required>
                  <option disabled>=== Chọn ===</option>
                  <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>Ẩn</option>
                  <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>Hiện</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input class="form-control" type="file" id="image" name="image">
              </div>
              <div class="mb-3">
                <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" width="200">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
      </div>
    </div>
  </form>
</div>
