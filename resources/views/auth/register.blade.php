@extends('layouts')

@section('content')
  <section id="form">
    <!--form-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="signup-form">
            <h2>Đăng ký!</h2>
            <!--sign up form-->
            <div class="social">
              <a href="{{ route('socialAuthRedirect', ['provider' => 'google']) }}" class="social-btn btn btn-default"
                style="background: #EA4335;">
                <i class="fa fa-google-plus"></i>
                Google
              </a>
              <a href="{{ route('socialAuthRedirect', ['provider' => 'facebook']) }}" class="social-btn btn btn-default"
                style="background: #0F91F3;">
                <i class="fa fa-facebook"></i>
                Facebook
              </a>
            </div>
            <h4 style="text-align: center;margin:2rem 0;">Hoặc</h4>

            <form method="POST" action="{{ route('register') }}">
              @csrf
              <input id="name" type="text" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                required autocomplete="name" autofocus placeholder="Họ tên" />
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror


              <input id="email" type="email" @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <input id="password" type="password" @error('password') is-invalid @enderror" name="password" required
                autocomplete="new-password" placeholder="Nhập mật khẩu">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <input id="password-confirm" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="Nhập lại mật khẩu">
              <button type="submit" class="btn btn-default">Đăng ký</button>
            </form>
          </div>
          <!--/sign up form-->
        </div>
      </div>
    </div>
  </section>
  <!--/form-->
@endsection
