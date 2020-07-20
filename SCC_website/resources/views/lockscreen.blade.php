<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Lockscreen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../assets/css/custom.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper lockscreen-wrapper-custom">
    <div class="login100-pic js-tilt" data-tilt>
        <img src="../assets/logo/hcmut-logo-removebg.png" alt="IMG">
    </div>
    <p class="login-box-msg login-box-msg-custom">SCC - @lang("Let's Sign In Again")</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- User name -->
    <div class="lockscreen-name">{{ session("1752051_user")["user_fullname"] }}</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">

        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="{{{ session("1752051_user")["user_avatar"] }}}" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form action="send-sign-in" method="post" class="lockscreen-credentials">
            {{csrf_field()}}
            <div class="input-group">
                <input type="email" name="user_email" value="{{{ session("1752051_user")["user_email"] }}}" hidden>
                <input type="password" class="form-control" name="user_password" placeholder="@lang("Password")">

                <div class="input-group-append">
                    <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
                </div>
            </div>
            <br>
            <div class="input-group">
                @if(Cookie::get('1752051_captcha') == true)
                    <div style="margin-left: -4.75rem"class="input-group mb-3">
{{--                        <label for="captcha">@lang('Captcha')</label>--}}
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    </div>
                @endif
            </div>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->



        <div class="help-block text-center">
            @lang('Enter your password to retrieve your session')
        </div>
    </form>
    <div class="text-center">
        <a href="sign-in">@lang('Or sign in as a different user')</a>
    </div>
    <div class="lockscreen-footer text-center">
        @lang("Copyright") &copy; 2019-2020 <b><a href="/" class="text-black">SCC</a></b> <b>@lang("Version")</b> 0.0.1 <br>
        @lang("All rights reserved.")
    </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tilt -->
<script src="../assets/js/tilt.jquery.min.js"></script>
</body>
</html>
