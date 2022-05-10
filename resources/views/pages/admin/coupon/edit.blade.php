<div class="modal fade" id="modalEdit{{ $coupon->id }}" tabindex="-1" aria-labelledby="modalEditLabel"
  aria-hidden="true">
  <form action="{{ route('admin.update.coupon', $coupon->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <div class="modal-dialog" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Cập nhật</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Mã giảm</label>
              <input type="text" class="form-control" value="{{ $coupon->code }}" name="code" id="code" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="exp_date" class="form-label">Ngày hết hạn</label>
              <input type="text" id="exp_date" name="exp_date" class="form-control" autocomplete="off"
                value="{{ $coupon->exp_date }}">
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
              <input type="number" class="form-control" value="{{ $coupon->quantity }}" name="quantity"
                id="quantity" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="value" class="form-label">Giảm</label>
              <input type="text" class="form-control" value="{{ $coupon->value }}" name="value" id="value" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="max_value" class="form-label">Giảm tối đa</label>
              <input type="text" class="form-control" value="{{ $coupon->max_value }}" name="max_value"
                id="max_value" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="status" class="form-label">Trạng thái</label>
              <select class="form-select" value="{{ $coupon->status }}" name="status" required>
                <option disabled>=== Chọn ===</option>
                <option value="0" {{ $coupon->status == '0' ? 'selected' : '' }}>Ẩn</option>
                <option value="1" {{ $coupon->status == '1' ? 'selected' : '' }}>Hiện</option>
              </select>
            </div>

          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button id="hello" type="submit" class="btn btn-success">Cập nhật</button>
        </div>
      </div>
    </div>
  </form>
</div>
