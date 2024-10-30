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
    <section class="order-confirm">
        <div class="order-confirm-detail">
            <div class="order-confirm-top">
                <span class="order-confirm-top-left">Xác nhận đơn hàng:</span>
                <span class="order-confirm-top-right">Nguyễn Thanh Hải#01</span>
            </div>
            <div class="order-confirm-content">
                <div class="order-confirm-bottom">
                    <p class="order-confirm-bottom-1">Đơn hàng của bạn đã được gửi <span class="order-confirm-bottom-2">Thành công</span><span class="order-confirm-bottom-3">!</span><br>
                    <span class="order-confirm-bottom-4">Vui lòng check <span class="order-confirm-bottom-5">Email</span> đã đăng ký để nhận và xác nhận Đơn hàng</span>
                    </p>
                    <button class="main-btn" onclick="window.location.href='/'">Tiếp tục mua hàng</button>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('client/parts/footer')
    </footer>
</body>
</html>