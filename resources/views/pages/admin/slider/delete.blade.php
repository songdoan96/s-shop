<div class="modal fade" id="modalDelete{{ $slider->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel"
  aria-hidden="true">
  <form action="{{ route('admin.destroy.slider', $slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("DELETE")
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Xóa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Bạn có muốn xóa slider này ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-danger">Xóa</button>
        </div>
      </div>
    </div>
  </form>
</div>
