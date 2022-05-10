 <div class="modal fade" id="modalEdit{{ $product->id }}" tabindex="-1" aria-labelledby="modalEditLabel"
   aria-hidden="true">
   <form action="{{ route('admin_update_product', $product->id) }}" method="POST" enctype="multipart/form-data">
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
             <div class="mb-3 col-md-12">
               <label for="name" class="form-label">Tên</label>
               <input type="text" value="{{ $product->name }}" class="form-control" name="name" id="name" required>
             </div>
             <div class="mb-3 col-md-6">
               <label for="name" class="form-label">Trạng thái</label>
               <select class="form-select" value="{{ $product->status }}" name=" status" required>
                 <option disabled>=== Chọn ===</option>
                 <option value="0" {{ $product->status == '0' ? 'selected' : '' }}>Ẩn</option>
                 <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Hiện</option>

               </select>
             </div>
             <div class="mb-3 col-md-6">
               <label for="category" class="form-label">Danh mục</label>
               <select class="form-select" value="{{ $product->category_id }}" name="category_id" required>
                 <option disabled>=== Chọn ===</option>
                 @foreach ($categories as $category)
                   <option value="{{ $category->id }}"
                     {{ $product->category_id == $category->id ? 'selected' : '' }}>
                     {{ $category->name }}
                   </option>
                 @endforeach
               </select>
             </div>
             <div class="mb-3 col-md-6">
               <label for="brand" class="form-label">Thương hiệu</label>
               <select class="form-select" value="{{ $product->brand_id }}" name="brand_id" required>
                 <option disabled>=== Chọn ===</option>
                 @foreach ($brands as $brand)
                   <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                     {{ $brand->name }}</option>
                 @endforeach
               </select>
             </div>
             <div class="mb-3 col-md-6">
               <label for="quantity" class="form-label">Số lượng</label>
               <input type="number" value="{{ $product->quantity }}" class="form-control" name="quantity"
                 id="quantity" required>
             </div>

             {{-- <div class="mb-3 col-md-6">
                             <label for="content" class="form-label">Nội dung</label>
                             <textarea type="text" class="form-control" name="content"
                                 id="content">{{ $product->content }}</textarea>
                         </div> --}}
             <div class="mb-3 col-md-6">
               <label for="price" class="form-label">Giá</label>
               <input value="{{ $product->price }}" type="number" class="form-control" name="price" id="price"
                 required>
             </div>
             <div class="mb-3 col-md-6">
               <label for="old_price" class="form-label">Giá cũ</label>
               <input value="{{ $product->old_price }}" type="number" class="form-control" name="old_price"
                 id="old_price">
             </div>

             <div class="mb-3 col-md-6">
               <label for="image" class="form-label">Hình ảnh</label>
               <input class="form-control" type="file" id="image" name="image">
             </div>
             <div class="mb-3 col-md-6">
               <label for="images" class="form-label">Bộ sưu tập</label>
               <input class="form-control" type="file" id="images" name="images[]" multiple>
             </div>
             <div class="mb-3 col-md-12">
               <label for="desc" class="form-label">Mô tả</label>
               <textarea type="text" class="form-control" name="desc" id="desc">{{ $product->desc }}</textarea>
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


 @include('vendor.tiny.tiny')
