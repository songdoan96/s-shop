<form method="POST" action="{{ route('admin.store.slider') }}" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel">Thêm slider</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">Tiêu đề</label>
              <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3 col-md-12">
              <label for="sub_title" class="form-label">Tiêu đề phụ</label>
              <input type="text" class="form-control" name="sub_title" required>
            </div>
            <div class="mb-3 col-md-12">
              <label for="desc" class="form-label">Mô tả</label>
              <input type="text" class="form-control" name="desc" required>
            </div>
            <div class="mb-3 col-md-12">
              <label for="link" class="form-label">Link</label>
              <input type="text" class="form-control" name="link" required>

            </div>

            <div class="mb-3 col-md-6">
              <label for="price" class="form-label">Giá</label>
              <input type="number" class="form-control" name="price" required>

            </div>

            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Trạng thái</label>
              <select class="form-select" name="status" required>
                <option disabled>=== Chọn ===</option>
                <option value="0">Ẩn</option>
                <option value="1">Hiện</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="image" class="form-label">Hình ảnh</label>
              <input class="form-control" type="file" id="image" name="image" required>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </div>
    </div>
  </div>

</form>
@push('script')
  <script>
    $(document).ready(function(e) {


      // Edit
      //   $(".edit_coupon").click(function(e) {
      //     let id = e.target.dataset.id;
      //     let url = `{{ url('/admin/edit-coupon/${id}') }}`;
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
    })
  </script>
@endpush
