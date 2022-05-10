@push('style')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
<form action="{{ route('admin.store.coupon') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel">Thêm mã</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Mã giảm</label>
              <input type="text" class="form-control" name="code" id="code" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="exp_date" class="form-label">Ngày hết hạn</label>
              <input type="text" id="exp_date" name="exp_date" class="form-control" autocomplete="off"
                readonly="readonly">
            </div>

            <div class="mb-3 col-md-6">
              <label for="type" class="form-label">Loại mã</label>
              <select class="form-select" name="type" required>
                <option disabled>=== Chọn ===</option>
                <option value="fixed">Trừ thẳng</option>
                <option value="percent">Phần trăm</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="quantity" class="form-label">Số lượng</label>
              <input type="number" class="form-control" name="quantity" id="quantity" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="value" class="form-label">Giảm</label>
              <input type="text" class="form-control" name="value" id="value" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="max_value" class="form-label">Giảm tối đa</label>
              <input type="text" class="form-control" name="max_value" id="max_value" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="status" class="form-label">Trạng thái</label>
              <select class="form-select" name="status" required>
                <option disabled>=== Chọn ===</option>
                <option value="0">Ẩn</option>
                <option value="1">Hiện</option>
              </select>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Thêm mã</button>
        </div>
      </div>
    </div>
  </div>

</form>
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script type="text/javascript">
    $(function() {
      $("#exp_date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i:ss",
      });
    });
  </script>
@endpush
