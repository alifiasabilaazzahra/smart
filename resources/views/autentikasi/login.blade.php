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

        <form action="/yand_login">
          <div class="login100-form validate-form">
            <span class="login100-form-title">
              SmarT
            </span>
            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
              <input class="input100" type="text" name="email" placeholder="Username">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Password is required">
              <input class="input100" type="password" name="password" placeholder="Password">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <p>
              
            </p>
            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit">
                Login
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