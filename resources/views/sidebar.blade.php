<div class="col-sm-3">
  <div class="left-sidebar">
    <h2>Danh mục</h2>
    <div class="panel-group category-products" id="accordian">

      @php
        $categories = App\Models\Category::where('status', '1')->get();
      @endphp

      @foreach ($categories as $category)
        <div class="panel panel-default">
          <div class="panel-heading">
            {{-- <h4 class="panel-title"><a
                                href="{{ route('shop.shop_view', ['category', $category->id]) }}"><span
                                    class="pull-right">({{ $category->product->where('status', '1')->count() }})</span>{{ $category->name }}</a>
                        </h4> --}}
            <h4 class="panel-title"><a href="{{ route('shop', ['category' => $category->id]) }}"><span
                  class="pull-right">({{ $category->product->where('status', '1')->count() }})</span>{{ $category->name }}</a>
            </h4>
          </div>
        </div>
      @endforeach

    </div>
    <!--/category-products-->

    <div class="brands_products">
      <!--brands_products-->
      <h2>Thương hiệu</h2>
      <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
          @php
            $brands = App\Models\Brand::where('status', '1')->get();
          @endphp

          @foreach ($brands as $key => $brand)
            <li>
              {{-- <a href="{{ route('shop.shop_view', ['brand', $brand->id]) }}"><span
                                    class="pull-right">({{ $brand->product->where('status', '1')->count() }})</span>{{ $brand->name }}</a> --}}
              <a href="{{ route('shop', ['brand' => $brand->id]) }}"><span
                  class="pull-right">({{ $brand->product->where('status', '1')->count() }})</span>{{ $brand->name }}</a>
            </li>
          @endforeach

        </ul>
      </div>
    </div>
    <!--/brands_products-->



    {{-- <div class="shipping text-center">
            <!--shipping-->
            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
        </div> --}}
    <!--/shipping-->

  </div>
</div>
