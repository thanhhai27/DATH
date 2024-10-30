<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/asset/css/confirm_success.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Dashboard_Admin</title>
</head>
<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="admin-sidebar-top">
                    <a href="/"><img src="{{asset('frontend/asset/images/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    @include('client/parts/header')
                </div>
            </div>
        </div>
    </section>
    <section class="info-detail">
        <div class="info-detail-overall">
            <h2>Thông tin cá nhân</h2>
            <img src="{{asset('frontend/asset/images/avatar_client.jpg')}}" alt="">
        </div>
        <div class="info-detail-body">
            <p>Tên: <span>{{ session('name') }}</span></p>
            <p>Email: <span>{{ session('email') }}</span></p>
            <p>Mật khẩu: <span id="password-display">**********</span><a id="eye-icon" class="ri-eye-off-fill"></a></p>
            <p class="hidden_password" style="display: none">{{ session('password') }}</p>
            <!-- Modal nhập mật khẩu -->
            <div class="passwordModal" id="passwordModal">
                <h3>Nhập mật khẩu để hiển thị</h3>
                <div class="passwordModal-detail">
                    <input type="password" id="passwordInput" placeholder="Nhập mật khẩu">
                    <button onclick="checkPassword()">Xác nhận</button>
                    <button onclick="closeModal()">Đóng</button>
                </div>
                <p id="error-message" style="color:red; display:none;">Mật khẩu không chính xác</p>
            </div>
        </div>
    </section>
    <footer>
        @include('client/parts/footer')
    </footer>
</body>
</html>