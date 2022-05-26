<header id="header">

    @php
        $settings = App\Models\Setting::findOrFail(1);
    @endphp
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{ $settings->phone }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ $settings->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="social-icons pull-right shop-menu shop-menu-top">
                        <ul class="nav navbar-nav">

                            @guest

                                @if (Route::has('login'))
                                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Đăng nhập</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}"><i class="fa fa-lock"></i> Đăng ký</a>
                                    </li>
                                @endif
                            @else
                                @if (Auth::user()->role == 'admin')
                                    <li class="dropdown">
                                        <a href="#" type="button" id="user_actions" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                            <span><i class="fa fa-user"></i>
                                                {{ Auth::user()->name }}</span>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="user_actions">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">Trang Admin</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i> Đăng xuất
                                                </a>
                                            </li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                @else
                                    <li class="dropdown">
                                        <a href="#" type="button" id="user_actions" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                            <span><i class="fa fa-user"></i>
                                                {{ Auth::user()->name }}</span>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="user_actions">
                                            <li>
                                                {{-- <a href="#">Thống kê</a> --}}
                                                <a href="{{ route('user.dashboard') }}">Thống kê</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.orders') }}">Đơn hàng của tôi</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.change_password') }}">Đổi mật khẩu</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i> Đăng xuất
                                                </a>
                                            </li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                @endif


                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">

        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3 header-middle__logo">
                    <div class="logo pull-left">
                        <a href="/"><img width="140" height="40" src="{{ asset('frontend/images/home/logo.png') }}"
                                alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-6 header-middle__search">
                    <form action="{{ route('shop.search') }}" method="post" id="search-wrap" class="search-bar">
                        @csrf
                        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." autocomplete="off">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="search-content">
                        {{-- <li>
              <img src="{{ asset("assets/images/QhsB67ae1QiYt1dIZrAPJMxCfXcP77JgtWo1Ysgq.jpg")}}" alt="">
              <span class="search-name">tempore aliquam est quidem in nostrum voluptate voluptatibus</span>
            </li>
            <li>
              <img src="{{ asset("assets/images/QhsB67ae1QiYt1dIZrAPJMxCfXcP77JgtWo1Ysgq.jpg")}}" alt="">
              <span class="search-name">tempore aliquam est quidem in nostrum voluptate voluptatibus</span>
            </li>
            <li>
              <img src="{{ asset("assets/images/QhsB67ae1QiYt1dIZrAPJMxCfXcP77JgtWo1Ysgq.jpg")}}" alt="">
              <span class="search-name">tempore aliquam est quidem in nostrum voluptate voluptatibus</span>
            </li>
            <li>
              <img src="{{ asset("assets/images/QhsB67ae1QiYt1dIZrAPJMxCfXcP77JgtWo1Ysgq.jpg")}}" alt="">
              <span class="search-name">tempore aliquam est quidem in nostrum voluptate voluptatibus</span>
            </li> --}}
                    </div>
                </div>

                <div class="col-sm-3 header-middle__cart">
                    <div class="shop-menu shop-menu-navbar pull-right">
                        <ul class="nav navbar-nav">
                            <li class="wishlist"><a href="{{ route('wishlist') }}"><i
                                        class="fa fa-heart"></i>
                                    <span class="wishlist-count badge">@include('wishlist_count')</span></a></li>
                            <li class="cart-nav"><a href="{{ route('cart') }}"><i
                                        class="fa fa-shopping-cart"></i>
                                    <span class="cart-count badge">@include('cart_count')</span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Home</a></li>
                            <li><a href="{{ route('shop') }}">Cửa hàng</i></a></li>
                            <li><a href="{{ route('checkout') }}">Thanh toán</i></a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ</i></a></li>

                            {{-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="blog.html">Blog List</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                  </ul>
                </li> --}}

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
@push('script')
    <script>
        $(document).ready(function() {
            $("input[name='search']").keyup(function(e) {
                const keywords = $(this).val();
                const url = "{{ route('home.autoSearch') }}";
                if (keywords != "") {
                    $.ajax({
                        url,
                        method: "POST",
                        data: {
                            keywords,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            console.log(res)
                            $(".search-content").addClass("active");

                            $(".search-content").html(res);
                        }
                    })
                } else {
                    $(".search-content").removeClass("active");
                    $(".search-content").html("");
                }
            });
        })
    </script>
@endpush
