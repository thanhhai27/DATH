<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{$title}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('authenticate/asset/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('authenticate/asset/css/reset.css')}}">
</head>
<body>
    <div id="login-page">
        <div id="form-login">
        <form action="/check_cli_login" method="POST">
            <div class="form-img-overall">
                <img class="form-img" src="{{asset('authenticate/asset/images/logo.png')}}" alt="">
            </div>
            <h1 class="form-heading">Đăng nhập</h1>
            <div class="form-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <div class="error-message">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <div class="form-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" class="form-input" placeholder="Mật khẩu">
                <div id="eye">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>
            @if ($errors->has('password'))
                <div class="error-message">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <div class="form-forgot-pass">
                <a href="/authentic/cli_forgetpw" class="forgot-pass">Quên mật khẩu ?</a>
            </div>            
            <button type="submit" class="form-submit">Đăng nhập</button>
            @csrf    
        </form>
            <div class="form-register">
                <h3>Bạn chưa có tài khoản?</h3>
                <input type="submit" value="Đăng Ký" class="register" onclick="window.location.href='/authentic/cli_register'">
            </div> 
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="{{asset('authenticate/asset/js/login.js')}}"></script>
</html>