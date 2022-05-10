<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators" style="bottom:-5rem;">
                        @foreach ($sliders as $key => $slider)
                            <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : null }}"></li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $slider)
                            <div class="item {{ $key == 0 ? 'active' : null }}">
                                <div class="col-xs-6 slider-content">
                                    <h1 style="height: 160px">{{ $slider->title }}</h1>
                                    <h2>{{ $slider->sub_title }}</h2>
                                    <p>{{ $slider->desc }} </p>
                                    <h2>{{ formatCurrent($slider->price) }} đ</h2>
                                    <a href="{{ $slider->link }}" class="btn btn-default get btn-lg">Chi tiết</a>
                                </div>
                                <div class="col-xs-6 slider-img">
                                    <img src="{{ asset('images/' . $slider->image) }}" class="girl img-responsive"
                                        alt="{{ $slider->title }}" style="object-fit:cover;" />
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="item active">
              <div class="col-sm-6">
                <h1><span>E</span>-SHOPPER</h1>
                <h2>Free E-Commerce Template</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. </p>
                <button type="button" class="btn btn-default get">Get it now</button>
              </div>
              <div class="col-sm-6">
                <img src="{{ asset('frontend/images/home/girl1.jpg') }}" class="girl img-responsive" alt="" />
                <img src="{{ asset('frontend/images/home/pricing.png') }}" class="pricing" alt="" />
              </div>
            </div>
            <div class="item">
              <div class="col-sm-6">
                <h1><span>E</span>-SHOPPER</h1>
                <h2>100% Responsive Design</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. </p>
                <button type="button" class="btn btn-default get">Get it now</button>
              </div>
              <div class="col-sm-6">
                <img src="{{ asset('frontend/images/home/girl2.jpg') }}" class="girl img-responsive" alt="" />
                <img src="{{ asset('frontend/images/home/pricing.png') }}" class="pricing" alt="" />
              </div>
            </div>
            <div class="item">
              <div class="col-sm-6">
                <h1><span>E</span>-SHOPPER</h1>
                <h2>Free Ecommerce Template</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. </p>
                <button type="button" class="btn btn-default get">Get it now</button>
              </div>
              <div class="col-sm-6">
                <img src="{{ asset('frontend/images/home/girl3.jpg') }}" class="girl img-responsive" alt="" />
                <img src="{{ asset('frontend/images/home/pricing.png') }}" class="pricing" alt="" />
              </div>
            </div> --}}

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
