@extends('layouts')

@section('sidebar')
    @include('sidebar')
@endsection
@section('content')
    <div class="col-sm-9 padding-right">
        @if (count($products) > 0)
            <div class="features_items">
                <!--features_items-->
                <h2 class="title text-center">{{ $name }}</h2>
                @if (Route::current()->getName() != 'shop.search')
                    <div class="row price-ranger-filter">
                        <div class="col-xs-6 col-sm-4">
                            <label for="">Sắp xếp</label>
                            <select class="form-control" name="sort" id="sort">
                                <option value="all" selected="">Tất cả</option>
                                <option value="newest" {{ Request::query('sort') === 'newest' ? 'selected' : '' }}>Mới
                                    nhất</option>
                                <option value="price_asc" {{ Request::query('sort') === 'price_asc' ? 'selected' : '' }}>
                                    Giá tăng dần
                                </option>
                                <option value="price_desc"
                                    {{ Request::query('sort') === 'price_desc' ? 'selected' : '' }}>Giá giảm dần
                                </option>
                                <option value="name_asc" {{ Request::query('sort') === 'name_asc' ? 'selected' : '' }}>Tên
                                    A-Z</option>
                                <option value="name_desc" {{ Request::query('sort') === 'name_desc' ? 'selected' : '' }}>
                                    Tên Z-A
                                </option>
                            </select>
                        </div>
                        <div class="col-xs-6 col-sm-6 pull-right">
                            <div class="price-title">
                                <label for="amount">Giá: </label>
                                <input type="text" id="amount" readonly disabled>
                            </div>
                            <div class="price-wrap">
                                <div id="slider-range"></div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 col-sm-6 mb-3">
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
                                            <a class="add-to-cart add-cart-home" data-type="cart"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-price="{{ $product->price }}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        </li>
                                    </ul>
                                    <span class="product-new-label">
                                        {{-- <i class="fa fa-heart"></i> --}}
                                    </span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a
                                            href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
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


                                    {{-- <ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star disable"></li>
                    <li class="fa fa-star disable"></li>
                  </ul> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
            <!--features_items-->
            {{ $products->appends(Request::query())->links('pagination') }}
        @else
            <div class="text-center" style="padding: 2rem;">
                <i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i>
                <h3>Không tìm thấy sản phẩm</h3>
                <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
            </div>
        @endif
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
                        console.log(res)
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
            })
        });
    </script>
@endpush


@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <style>
        .price-ranger-filter {
            height: 100px;
            padding-bottom: 3rem;
        }

        #slider-range {
            background-color: #f7f7f7;
            box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
            border-radius: 15px;
        }

        .price-wrap {
            width: 80%;
            margin-top: 2rem;
        }

        .price-title input {
            width: 80%;
            background: transparent;
            border: none;
            margin-left: 2rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        #slider-range .ui-slider-range {
            background: var(--primary-color);
        }

        #slider-range .ui-slider-handle {
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15) inset;
            border-radius: 15px;
        }

        .ui-slider-horizontal {
            height: .85rem;
        }

        .ui-slider-horizontal .ui-slider-handle {
            top: -6px;
        }

    </style>
@endpush
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            function formatCurrent(price) {
                return price.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                })
            }
            const productMinPrice = {{ productMinPrice() }};
            const productMaxPrice = {{ productMaxPrice() }};
            const fullUrl = "{{ Request::fullUrl() }}";
            var query;
            if (fullUrl.includes("sort")) {
                query = {
                    ...query,
                    sort: "{{ Request::query('sort') }}",
                }
            }
            if (fullUrl.includes("brand")) {
                query = {
                    ...query,
                    brand: "{{ Request::query('brand') }}",
                }
            }
            if (fullUrl.includes("category")) {
                query = {
                    ...query,
                    category: "{{ Request::query('category') }}",
                }
            }


            $("#slider-range").slider({
                range: true,
                step: 100000,
                min: productMinPrice,
                max: productMaxPrice,
                values: ["{{ Request::query('min_price') }}" || productMinPrice,
                    "{{ Request::query('max_price') }}" || productMaxPrice
                ],
                slide: function(event, ui) {
                    $("#amount").val(formatCurrent(ui.values[0]) + "  -  " + formatCurrent(ui.values[
                        1]));
                    min_price = $("#slider-range").slider("values", 0)
                    max_price = $("#slider-range").slider("values", 1)
                    query = {
                        ...query,
                        min_price,
                        max_price
                    }
                    window.location.href = "{{ route('shop') }}" + '?' + $.param(query)
                }
            });
            $("#amount").val(formatCurrent($("#slider-range").slider("values", 0)) + "  -  " + formatCurrent($(
                "#slider-range").slider("values", 1)));

            $("#sort").change(function(e) {
                e.preventDefault();
                sort = $(this).val();
                query = {
                    ...query,
                    sort
                }
                window.location.href = "{{ route('shop') }}" + '?' + $.param(query)
            });



        })
    </script>
@endpush
