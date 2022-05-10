@extends('layouts')
@section('content')

  @if (Cart::instance('cart')->count() > 0)
    <section id="cart_items" style="margin-bottom: 4rem !important;">
      <div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Thanh toán</li>
          </ol>
        </div>
        <!--/breadcrums-->


        <!--/checkout-options-->

        <div class="register-req">
          <p>Điền đầy đủ thông tin để tiến hành thanh toán</p>
        </div>
        <!--/register-req-->


        @if (!session('coupon'))
          <div class="row bill-to">
            <p style="margin-left: 15px">Mã giảm giá:</p>
            <div class="col-sm-6">
              <div class="form-one" style="width: 100%;">
                <form action="{{ route('checkout.applyCouponCode') }}" method="post">
                  @csrf
                  <input type="text" name="code" placeholder="Mã giảm giá (nếu có):" class="half-width">
                  <button type="submit" class="btn btn-primary btn-default" style="margin: 0 0 0 1rem;">Áp mã</button>
                </form>
              </div>
            </div>
          </div>
        @endif

        <div class="shopper-informations">
          <div class="row">
            <form action="{{ route('order') }}" method="post" id="place-order">
              @csrf
              <div class="col-sm-6 clearfix">
                <div class="bill-to">
                  <p>Địa chỉ thanh toán</p>
                  <div class="form-one" style="width: 100%">

                    @if (!session('address'))
                      <select class="choose" id="city" name="fee_matp">
                        <option>Tỉnh, thành phố * </option>
                        @foreach ($cities as $city)
                          <option value="{{ $city->matp }}">
                            {{ $city->tp_name }}</option>
                        @endforeach
                      </select>

                      <select class="choose" id="province" name="fee_maqh">
                        <option>Huyện * </option>

                      </select>

                      <select name="fee_xaid" id="ward">
                        <option>Xã * </option>

                      </select>
                    @endif


                    <input required type="text" name="full_name" value="{{ old('full_name') }}"
                      placeholder="Họ và tên *">
                    <input required type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại *">
                    <input required type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                    <input required type="text" name="street" value="{{ old('street') }}"
                      placeholder="Số nhà, đường, thôn *">



                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="order-message">
                  <p>Ghi chú</p>
                  <textarea name="note" placeholder="Thêm ghi chú cho đơn hàng" rows="16" style="height:190px;"></textarea>
                </div>
              </div>

            </form>
          </div>
        </div>

        <div class="review" style="padding:0 0 5rem 0;">
          <div class="shopper-info">
            <p>Đơn hàng</p>
          </div>
          <div class="row ">
            <div class="col-sm-4">
              <h5>Tổng tiền hàng: <span>{{ formatCurrent(Cart::instance('cart')->subtotal()) }}</span></h5>

              @if (session('coupon'))
                <h5>Mã giảm giá: <span>{{ session('coupon')['code'] }}</span>
                  <form action="{{ route('checkout.deleteCouponCode') }}" style="display: inline-block;" method="post">
                    @csrf
                    <button type="submit" class="delete-coupon"><i class="fa fa-times"></i></button>
                  </form>
                </h5>
              @endif

              @if (session('checkout'))
                <h5>Tiết kiệm: <span>{{ formatCurrent(session('checkout')['discount']) }}</span></h5>
                @if (session('checkout')['tax'] != 0)
                  <h5>Thuế: <span>{{ formatCurrent(session('checkout')['tax']) }}</span></h5>
                @endif
                @if (session('address'))
                  <h5>Phí ship: <span>{{ formatCurrent(session('address')['price']) }}</span></h5>
                  <i>Địa chỉ: {{ session('address')['xa_name'] }}, {{ session('address')['qh_name'] }},
                    {{ session('address')['tp_name'] }} <a href="#" style="margin-left: 1rem;"
                      onclick="$('#editAdress').submit();">Thay đổi địa chỉ</a></i>
                @endif
                <hr>
                <h4>Thành tiền: <span>{{ formatCurrent(session('checkout')['total']) }}</span></h4>
              @endif

            </div>

            {{-- <div class="col-sm-4">
            <div class="form-one" style="width: 100%">
              <form action="{{ route('checkout.applyCouponCode') }}" method="post">
                @csrf
                <input type="text" name="code" placeholder="Mã giảm giá (nếu có):" class="half-width">
                <button type="submit" class="btn btn-primary btn-default" style="margin: 0 0 0 1rem;">Áp mã</button>
              </form>
            </div>
          </div> --}}
            <div class="col-sm-8">
              <button onclick="$('#place-order').submit();" class="btn btn-lg btn-primary pull-right"
                style="margin-top: 15rem;width: 200px;">Đặt
                hàng</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <form id="editAdress" action="{{ route('checkout.address.delete') }}" method="post">@csrf</form>
  @else
    <div class="text-center" style="padding: 2rem 0 30vh;">
      <i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i>
      <h3>Giỏ hàng trống</h3>
      <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
    </div>
  @endif
@endsection

@push('script')
  <script>
    $(document).ready(function(e) {
      $('.choose').change(function(e) {
        let name = e.target.id;
        let valueId = $(this).val();
        let html = name === "city" ? "province" : "ward";
        let url = `{{ route('checkout.address.fee') }}`;
        $(`#${html}`).html("");
        $.ajax({
          url,
          method: "POST",
          data: {
            name,
            valueId,
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            $(`#${html}`).html(res);
          }
        })

      })
      $('#ward').change(function(e) {
        let matp = $("#city").val();
        let maqh = $("#province").val();
        let xaid = $("#ward").val();
        let url = `{{ route('checkout.calculate.fee') }}`;
        $.ajax({
          url,
          method: "POST",
          data: {
            matp,
            maqh,
            xaid,
            "_token": "{{ csrf_token() }}",
          },
          success: function(res) {
            location.reload();
          }
        })
      })
    })
  </script>
@endpush
