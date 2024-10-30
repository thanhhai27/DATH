@extends('admin.main')
@section('content')
    <div class="form-group-admin-info">
        <p>Tên: <span>{{ session('name') }}</span></p>
        <p>Email: <span>{{ session('email') }}</span></p>
        <p>Mật khẩu: <span id="password-display">**********</span><a id="eye-icon" class="ri-eye-off-fill"></a></p>
        <p class="hidden_password" style="display: none">{{ session('password') }}</p>
    </div>

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
@endsection