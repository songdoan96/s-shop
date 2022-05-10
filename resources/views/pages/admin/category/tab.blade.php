@extends('admin')
@section('admin_content')
    <div class="container-fluid px-4 content">
        <h3 class="mt-4">Tab danh mục</h3>
        <div class="card my-4">
            <div class="card-header">
                Chọn tab mục trang chủ
            </div>
            <div class="card-body">
                <form action="{{route('admin_category_add_show_tab')}}" method="post">
                    @csrf
                    @foreach($categories as $category)
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="tab_show[]" value="{{$category->id}}"
                                   id="{{$category->name}}" {{ in_array($category->id,$tabs) ?'checked':null }}>
                            <label class="form-check-label" for="{{$category->name}}">
                                {{$category->name}}
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-3">Sửa</button>
                </form>
            </div>
        </div>
    </div>
@endsection

