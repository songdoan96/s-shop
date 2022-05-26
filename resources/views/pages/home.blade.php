@extends('layouts')
@section('slider')
    @include('slider')
@endsection
{{-- @section('sidebar')
  @include('sidebar')
@endsection --}}
@section('content')
    <div class="container">

        <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center " style="margin:3rem 0;">Sản phẩm mới nhất</h2>
            @foreach ($products as $product)
                <div class="col-xs-12 col-sm-4 col-md-3 mb-3">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="{{ route('product.details', $product->slug) }}">
                                <img class="pic-1" src="{{ asset('images/' . $product->image) }}">
                                @empty(!explode('|', $product->images)[0])
                                    <img class="pic-2"
                                        src="{{ asset('images/' . explode('|', $product->images)[0]) }}">
                                @endempty
                            </a>
                            <ul class="social">
                                <li>
                                    <a class="add-to-wishlist add-wishlist-home" data-type="wishlist"
                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}"><i class="fa fa-heart"></i></a>
                                </li>
                                <li>
                                    <a class="add-to-cart add-cart-home" data-type="cart" data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}" data-price="{{ $product->price }}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">
                                {{-- @if ($wishlists->contains($product->id))
                  <i class="fa fa-heart"></i>
                @endif --}}
                            </span>
                        </div>
                        <div class="product-content">
                            <p class="title">
                                <a class="title" href="{{ route('product.details', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </p>
                            <div class="price">
                                {{ formatCurrent($product->price) }}
                                <span>{{ formatCurrent($product->old_price) }}</span>
                            </div>

                            @php
                                $sum_rating = 0;
                                foreach ($product->orderItems->where('r_status', 1) as $key => $orderItem) {
                                    $sum_rating += $orderItem->review->rating;
                                }
                                $count_rating = $product->orderItems->where('r_status', 1)->count();
                                $avg_rating = $count_rating ? $sum_rating / $count_rating : 0;
                            @endphp

                            <div class="star-rating" style="margin: 1rem 0">
                                <span style="width: {{ $avg_rating * 20 }}%;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <!--features_items-->
        <div class="category-tab">
            <h2 class="title text-center " style="margin:3rem 0;">Danh mục sản phẩm</h2>

            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    @foreach ($categories_tab as $key => $tab)
                        <li class="{{ $key == 0 ? 'active' : null }}"><a href="#tab-{{ $tab->id }}"
                                data-toggle="tab">{{ $tab->name }}</a></li>
                    @endforeach

                </ul>
            </div>
            <div class="tab-content">
                @foreach ($categories_tab as $key => $tab)
                    <div class="tab-pane fade {{ $key == 0 ? 'active in' : null }}" id="tab-{{ $tab->id }}">
                        @php
                            $products_tab = DB::table('products')
                                ->where('status', '1')
                                ->where('category_id', $tab->id)
                                ->inRandomOrder()
                                ->take(4)
                                ->get();
                        @endphp

                        @if (count($products_tab) > 0)
                            @foreach ($products_tab as $product)
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img height="190" src="{{ asset('images/' . $product->image) }}"
                                                    alt="{{ $product->name }}" />
                                                <h2>{{ formatCurrent($product->price) }}</h2>
                                                <p>{{ $product->name }}</p>

                                                <button class="btn btn-default add-to-cart" data-type="cart"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-price="{{ $product->price }}"><i
                                                        class="fa fa-shopping-cart"></i>Thêm vào
                                                    giỏ
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center">Không tìm thấy sản phẩm</h3>
                        @endif

                    </div>
                @endforeach


            </div>
        </div>
        <!--/category-tab-->

        <div class="recommended_items">
            <!--recommended_items-->
            <h2 class="title text-center " style="margin:3rem 0;">Sản phẩm nổi bật</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $pro = DB::table('products')
                            ->inRandomOrder()
                            ->where('status', '1')
                            ->take(16)
                            ->get();
                        
                        $collection = collect($pro);
                        $chunks = $collection->chunk(4);
                        $chunks->all();
                    @endphp


                    @foreach ($chunks as $key => $chunk)
                        <div class="item {{ $key == 0 ? 'active' : null }}">
                            @foreach ($chunk as $product)
                                <div class="col-xs-6 col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img width="200" src="{{ asset('images/' . $product->image) }}" alt="" />
                                                <h2>{{ formatCurrent($product->price) }}</h2>
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    <p>{{ $product->name }}</p>
                                                </a>
                                                <button class="btn btn-default add-to-cart" data-type="cart"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-price="{{ $product->price }}"><i
                                                        class="fa fa-shopping-cart"></i>Thêm vào
                                                    giỏ
                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endforeach


                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <!--/recommended_items-->
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            // Edit
            $(".add-to-cart,.add-to-wishlist").click(function(e) {
                let id = $(this).data("id");
                let type = $(this).data("type");
                let name = $(this).data("name");
                let price = $(this).data("price");
                let qty = $(this).data("qty") || 1;
                let url = type === 'cart' ? "{{ route('cart.store') }}" :
                    "{{ route('wishlist.store') }}";
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
                        // $.ajax({
                        //   url: "{{ route('cart.count') }}",
                        //   method: "GET",
                        //   success: function(res) {
                        //     $(".cart-count").html(res)

                        //     const Toast = Swal.mixin({
                        //       toast: true,
                        //       position: 'bottom-end',
                        //       showConfirmButton: false,
                        //       timer: 2000,
                        //       timerProgressBar: true,
                        //     })

                        //     Toast.fire({
                        //       icon: 'success',
                        //       title: 'Thêm thành công',
                        //       padding: '1em',
                        //       showCloseButton: true
                        //     })
                        //   }
                        // })

                    }
                })
            })
        });
    </script>
@endpush
