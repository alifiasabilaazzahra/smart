@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/css/util.css">
  <link rel="stylesheet" type="text/css" href="/assets/logtmp/css/main.css">
  <style>
    .p0{
      padding: 0;
      margin: 0;
    }
  </style>
  <link rel="icon" href="/assets/img/logo/logo.png">
  
</head>
<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 pt-5">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="/assets/img/logo/logo.png" alt="IMG">
        </div>

        <div class="alert-danger">
          @if(isset($message))
            {{$message}}
          @endif
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
          <div class="login100-form validate-form">
            <span class="login100-form-title">
                <div>{{ __('Login') }}</div>
            </span>
            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
              <input class="input100 @error('email') is-invalid @enderror" name="email" placeholder="Email" id="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Password is required">
              <input class="input100  @error('password') is-invalid @enderror" type="password" id="password" name="password" required autocomplete="current-password">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input">
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            <p>
              
            </p>
            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit">
                {{ __('Login') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  
  <script src="/assets/logtmp/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="/assets/logtmp/vendor/bootstrap/js/popper.js"></script>
  <script src="/assets/logtmp/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets/logtmp/vendor/select2/select2.min.js"></script>
  <script src="/assets/logtmp/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
  <script src="/assets/logtmp/js/main.js"></script>

</body>
</html>
@endsection
