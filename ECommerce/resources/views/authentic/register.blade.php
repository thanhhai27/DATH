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
    <link rel="stylesheet" href="{{asset('authenticate/asset/css/register.css')}}">
    <link rel="stylesheet" href="{{asset('authenticate/asset/css/reset.css')}}">
</head>
<body>
    <div id="wrapper">
        <div id="form-register">
        <form action="/check_register" method="POST">
            <div class="form-img-overall">
                <img class="form-img" src="{{asset('authenticate/asset/images/logo.png')}}" alt="">
            </div>
            <h1 class="form-heading">Đăng ký</h1>
            <div class="form-name">
                <input type="text" name="name" class="form-input-name" placeholder="Tên" value="{{ old('name') }}">
            </div>        
            @if ($errors->has('name'))
                <div class="error-message">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <div class="form-group">
                <input type="text" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <div class="error-message">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <div class="form-group">
                <input type="password" name="password" class="form-input" placeholder="Nhập mật khẩu" value="{{ old('password') }}">
                <div class="eye">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>
            @if ($errors->has('password'))
                <div class="error-message">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-input" placeholder="Nhập lại mật khẩu">
                <div class="eye">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>   
            @if ($errors->has('password_confirmation'))
                <div class="error-message">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
            <div class="terms-and-privacy">
                <label>
                    <input type="checkbox" class="checkbox" name="terms">
                </label>
                <span class="un-link">Tôi đồng ý với</span>
                <a href="https://policies.google.com/terms?hl=vi" target="_blank" class="link">Điều Khoản Dịch Vụ</a>
                <span class="un-link">và</span>
                <a href="https://policies.google.com/privacy?hl=vi" target="_blank" class="link">Chính Sách Bảo Mật</a>
            </div>  
            @if ($errors->has('terms'))
                <div class="error-message">
                    {{ $errors->first('terms') }}
                </div>
            @endif                        
             <button type="submit" class="form-submit">Đăng ký</button>
             @csrf
        </form>
            <div class="form-return">
                <input type="submit" value="Quay lại trang đăng nhập" class="return" onclick="window.location.href='/authentic/login'">
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="{{asset('authenticate/asset/js/register.js')}}"></script>
</html>