@extends('layouts')

@section('sidebar')
  @include('sidebar')
@endsection
@section('content')
  <div class="col-sm-9 padding-right">
    <div class="product-details">
      <!--product-details-->
      <div class="col-sm-5">
        <div class="view-product">
          <img src="{{ asset('images/' . $product->image) }}" alt="">
          {{-- <h3>ZOOM</h3> --}}
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

          <!-- Wrapper for slides -->
          @php
            $images = explode('|', $product->images);
            $collection = collect($images);
            $chunks = $collection->chunk(3);
            $chunks->all();
          @endphp
          <div class="carousel-inner">
            @foreach ($chunks as $key => $chunk)
              <div class="item {{ $key === 0 ? 'active' : null }}">
                @foreach ($chunk as $img)
                  <a href=""><img src="{{ asset('images/' . $img) }}" alt="" width="84"></a>
                @endforeach
              </div>
            @endforeach
          </div>

          <!-- Controls -->
          <a class="left item-control" href="#similar-product" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right item-control" href="#similar-product" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>

      </div>
      <div class="col-sm-7">
        <div class="product-information">
          <!--/product-information-->
          {{-- <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt=""> --}}
          <h2>{{ $product->name }}</h2>
          <p>Mã sản phẩm: {{ $product->id }}</p>
          <p>
            {{-- <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt=""> --}}
          <div class="star-rating">
            <span style="width:{{ $avg_rating }}%;top:-18px;"></span>
          </div>
          </p>
          <span>
            <span>{{ formatCurrent($product->price) }}</span>
          </span>


          @if ($product->quantity)
            <p>
              {{-- <label for="validationCustom01" class="form-label">Số lượng:</label> --}}
            <div class="col-md-3">
              <input type="text" class="form-control" name="qty" id="qty" name="qty" value="1" required>
            </div>
            <div class="col-8">
              <button class="btn btn-default add-to-cart" data-type="cart" data-id="{{ $product->id }}"
                data-name="{{ $product->name }}" data-price="{{ $product->price }}"><i
                  class="fa fa-shopping-cart"></i>Thêm vào giỏ
              </button>
            </div>
            </p>
          @endif

          <p><b>Tình trạng:</b>
            @if ($product->quantity)
              Còn hàng ({{ $product->quantity }})
            @else
              <span class="text-danger">Hết hàng</span>
            @endif
          </p>
          <p><b>Danh mục:</b> {{ $product->category->name }}</p>
          <p><b>Thương hiệu:</b> {{ $product->brand->name }}</p>
          <a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"
              alt=""></a>
        </div>
        <!--/product-information-->
      </div>
    </div>
    <!--/product-details-->

    <div class="category-tab shop-details-tab">
      <!--category-tab-->
      <div class="col-sm-12">
        <ul class="nav nav-tabs">
          {{-- <li><a href="#details" data-toggle="tab">Tổng quan</a></li> --}}
          <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
          <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá ({{ $reviews->count() }})</a></li>
        </ul>
      </div>
      <div class="tab-content">
        {{-- <div class="tab-pane fade" id="details">
                  {{ $product->content }}
                  content
                </div> --}}

        <div class="tab-pane fade" id="companyprofile">
          {!! $product->desc !!}
        </div>


        <div class="tab-pane fade active in" id="reviews">
          <div id="comments">

            <ol class="commentlist">
              @foreach ($reviews as $orderItem)
                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                  <div id="comment-20" class="comment_container">
                    <img alt="" src="{{ asset('assets/images/avatar.png') }}" height="80" width="80">
                    <div class="comment-text">
                      <div class="star-rating">
                        <span class="width-{{ $orderItem->review->rating * 20 }}-percent">Đánh giá <strong
                            class="rating">{{ $orderItem->review->rating }}</strong> trên
                          5</span>
                      </div>
                      <p class="meta">
                        <strong class="woocommerce-review__author">{{ $orderItem->order->user->name }}</strong>
                        <span class="woocommerce-review__dash">–</span>
                        <time
                          class="woocommerce-review__published-date">{{ Carbon\Carbon::parse($orderItem->review->created_at)->format('H:i - d/m/Y') }}</time>
                      </p>
                      <div class="description">
                        <p>{{ $orderItem->review->comment }}</p>
                      </div>
                    </div>
                  </div>
                </li>
              @endforeach
            </ol>
          </div><!-- #comments -->
          {{ $reviews->links('pagination') }}
        </div>
      </div>
      <!--/category-tab-->


    </div>
  @endsection



  @push('script')
    <script>
      $(document).ready(function() {

        const productQty = '{{ $product->quantity }}';

        $(".add-to-cart").click(function(e) {
          let id = $(this).data("id");
          let type = $(this).data("type");
          let name = $(this).data("name");
          let price = $(this).data("price");
          let qty = $("#qty").val() || 1;
          let url = type === 'cart' ? "{{ route('cart.store') }}" : "{{ route('wishlist.store') }}";


          if (Number(qty) <= Number(productQty)) {
            $.ajax({
              url,
              method: "POST",
              data: {
                id,
                name,
                price,
                qty,
                _token: "{{ csrf_token() }}"
              },
              success: function(res) {

                $(`.${type}-count`).html(res)

                const Toast = Swal.mixin({
                  toast: true,
                  position: 'bottom-end',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                })

                Toast.fire({
                  icon: 'success',
                  title: 'Thêm thành công',
                  padding: '1em',
                  showCloseButton: true
                })


              }
            })
          } else {
            Swal.fire({
              icon: 'error',
              text: `Hết hàng! Số lượng hàng còn ${productQty} sản phẩm.`,
            })
          }

        })
      });
    </script>
  @endpush
