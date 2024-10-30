<div class="admin-content-top-left">
    <form action="{{ route('client.search') }}" method="GET">
        <div class="header-search">
            <input type="text" name="keyword" placeholder="Tìm kiếm" value="{{ request()->input('keyword') }}">
            <button type="submit">
                <i class="ri-search-line"></i>
            </button>
        </div>
    </form>
</div>
<div class="admin-content-top-right">
    <ul class="flex-box">
        <li class="cart-noti"><i class="ri-shopping-cart-line" number="0"></i></li>
        <li class="cart-noti"><i class="ri-notification-4-line" number='3'></i></li>
        <li class="flex-box profile-menu">
            <img style="width: 45px;" src="{{asset('frontend/asset/images/profile.png')}}">
            <i style="font-size: 23px;" class="ri-arrow-down-s-fill"></i>
            <!-- Dropdown menu hiển thị khi nhấn vào flex-box -->
            <div class="dropdown-content">
                <ul>
                    <li><a href="/client/client_info">Thông tin cá nhân</a></li>
                    <li><a href="#">Đổi mật khẩu</a></li>
                    <li><a href="#">Lịch sử mua hàng</a></li>
                    <li><a href="/authentic/cli_login">Đăng xuất</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>