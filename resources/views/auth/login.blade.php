@extends('layouts')

@section('content')
  <section id="form">
    <!--form-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="login-form">
            <!--login form-->
            <h2>Đăng nhập</h2>
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
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

              @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password" placeholder="Mật khẩu">

              @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <div></div>
              <span>
                <input class="checkbox" type="checkbox" name="remember" id="remember"
                  {{ old('remember') ? 'checked' : '' }}>
                Lưu đăng nhập
              </span>
              @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  Quên mật khẩu
                </a>
              @endif


              <button type="submit" class="btn btn-default">Đăng nhập</button>
            </form>
          </div>
          <!--/login form-->

        </div>

      </div>
    </div>
  </section>
@endsection
