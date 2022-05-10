@extends('admin')
@section('admin_content')
  <div class="container-fluid px-4 content">
    <h4 class="mt-4">Thông tin</h4>
    <div class="card my-4">
      <div class="card-header">
        Tùy chỉnh thông tin liên lạc
      </div>
      <div class="card-body">

        <form method="POST" action="{{ route('admin.setting.save') }}">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" name="email" value="{{ $settings->email }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="phone" class="form-label">SĐT</label>
              <input type="text" name="phone" value="{{ $settings->phone }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="phone2" class="form-label">SĐT khác</label>
              <input type="text" name="phone2" value="{{ $settings->phone2 }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Địa chỉ</label>
              <input type="text" name="address" value="{{ $settings->address }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="facebook" class="form-label">Facebook</label>
              <input type="text" name="facebook" value="{{ $settings->facebook }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="youtube" class="form-label">youtube</label>
              <input type="text" name="youtube" value="{{ $settings->youtube }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="map" class="form-label">map</label>
              <input type="text" name="map" value="{{ $settings->map }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="twitter" class="form-label">twitter</label>
              <input type="text" name="twitter" value="{{ $settings->twitter }}" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
              <label for="instagram" class="form-label">instagram</label>
              <input type="text" name="instagram" value="{{ $settings->instagram }}" class="form-control">
            </div>
          </div>
          <button type="submit" class="btn btn-primary my-3">Cập nhật</button>
        </form>
      </div>
    </div>
  </div>
@endsection
