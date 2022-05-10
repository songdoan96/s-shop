<form method="POST" action="{{ route('admin.store.fee') }}" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel">Thêm sản phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="fee_matp" class="form-label">Tỉnh, thành phố</label>
              <select class="form-select choose" id="city" name="fee_matp" required>
                <option>=== Chọn ===</option>
                @foreach ($cities as $city)
                  <option value="{{ $city->matp }}">{{ $city->tp_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="fee_maqh" class="form-label">Quận, huyện</label>
              <select class="form-select choose" id="province" name="fee_maqh" name="fee_maqh" required>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="brand" class="form-label">Xã, phường</label>
              <select class="form-select" name="fee_xaid" required id="ward">
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="price" class="form-label">Phí</label>
              <input type="text" class="form-control" name="price" id="price" required>
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
      $('.choose').change(function(e) {
        let name = e.target.id;
        let valueId = $(this).val();
        let valueIdd = $("#city").val();
        let html = name === "city" ? "province" : "ward";
        let url = `{{ route('admin.address.fee') }}`;
        $(`#${html}`).html("");
        $.ajax({
          url,
          method: "POST",
          data: {
            name,
            valueId,
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            console.log(res)
            $(`#${html}`).html(res);
          }
        })
      })

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
