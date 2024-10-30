<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\client_users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LogController extends Controller
{
    // PHẦN LOGIN-REGISTER-FORGET CỦA ADMIN
    public function show_login(){
        return view('authentic.login',[
            'title' => 'Đăng nhập',
        ]);
    }

    public function check_login(Request $request){
        // Khởi tạo biến lỗi
        $errors = [];
    
        // Kiểm tra trường email
        $email = $request->input('email');
        if (empty($email)) {
            $errors['email'] = 'Email là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
            return redirect()->back()->withErrors($errors)->withInput();
        }
    
        // Kiểm tra trường mật khẩu
        $password = $request->input('password');
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        }
    
        // Thử đăng nhập
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Đăng nhập thành công, lấy thông tin người dùng
            $user = Auth::user();

            // Lưu thông tin người dùng vào session
            session([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $password // Lưu ý: không hiển thị mật khẩu dưới dạng plain text trong thực tế
            ]);
            return redirect('admin');
        } else {
            // Nếu mật khẩu không đúng, thêm lỗi vào biến lỗi
            $errors['password'] = 'Mật khẩu không đúng';
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    
    public function show_register(){
        return view('authentic.register',[
            'title' => 'Đăng ký',
        ]);
    }
    public function check_register(Request $request)
    {
        // Khởi tạo biến lỗi
        $errors = [];

        // Kiểm tra trường tên
        if (empty($request->input('name'))) {
            $errors['name'] = 'Tên là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường email
        $email = $request->input('email');
        if (empty($email)) {
            $errors['email'] = 'Email là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (User::where('email', $email)->exists()) {
            $errors['email'] = 'Email đã tồn tại';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường mật khẩu
        $password = $request->input('password');
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường xác nhận mật khẩu
        $passwordConfirmation = $request->input('password_confirmation');
        if (empty($passwordConfirmation)) {
            $errors['password_confirmation'] = 'Bạn cần xác nhận lại mật khẩu';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        elseif ($password !== $passwordConfirmation) {
            $errors['password_confirmation'] = 'Mật khẩu xác nhận không khớp';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường đồng ý với điều khoản
        if (!$request->has('terms')) {
            $errors['terms'] = 'Bạn phải đồng ý với Điều Khoản Dịch Vụ và Chính Sách Bảo Mật.';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Nếu không có lỗi, lưu người dùng
        $user = new User();
        $user->name = $request->input('name');
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->save();

        return redirect('/authentic/login');
    }
    public function show_forgetpw(){
        return view('authentic.forgetpw',[
            'title' => 'Quên mật khẩu'
        ]);
    }

    public function edit_pass(Request $request)
    {
        // Khởi tạo biến lỗi
        $errors = [];

        // Kiểm tra trường email
        $email = $request->input('email');
        if (empty($email)) {
            $errors['email'] = 'Email là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!User::where('email', $email)->exists()) {
            $errors['email'] = 'Email không tồn tại';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường mật khẩu
        $password = $request->input('password');
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        
        // Kiểm tra trường xác nhận mật khẩu
        $passwordConfirmation = $request->input('password_confirmation');
        if (empty($passwordConfirmation)) {
            $errors['password_confirmation'] = 'Bạn cần xác nhận lại mật khẩu';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        elseif ($password !== $passwordConfirmation) {
            $errors['password_confirmation'] = 'Mật khẩu xác nhận không khớp';
            return redirect()->back()->withErrors($errors)->withInput();
        }


        // Cập nhật mật khẩu
        $user = DB::table('users')->where('email', $email)->first();
        
        if ($user) {
            DB::table('users')->where('email', $email)->update([
                'password' => Hash::make($password) // Băm mật khẩu trước khi lưu
            ]);

            return redirect('/authentic/login');
        }
    }


    // PHẦN LOGIN-REGISTER-FORGET CỦA CLIENT
    public function show_cli_login(){
        return view('authentic.cli_login',[
            'title' => 'Đăng nhập',
        ]);
    }

    public function check_cli_login(Request $request){
        // Khởi tạo biến lỗi
        $errors = [];
    
        // Kiểm tra trường email
        $email = $request->input('email');
        if (empty($email)) {
            $errors['email'] = 'Email là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
            return redirect()->back()->withErrors($errors)->withInput();
        }
    
        // Kiểm tra trường mật khẩu
        $password = $request->input('password');
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Thử đăng nhập bằng cách kiểm tra bảng client_users
        $user = client_users::where('email',$email)->first();

        if ($user && $user->password === $password) {
            // Đăng nhập thành công, lưu thông tin vào session
            session([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $password
            ]);
            return redirect('/');
        } else {
            // Nếu mật khẩu không đúng, thêm lỗi vào biến lỗi
            $errors['password'] = 'Mật khẩu không đúng';
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function show_cli_register(){
        return view('authentic.cli_register',[
            'title' => 'Đăng ký',
        ]);
    }

    public function check_cli_register(Request $request){
        // Khởi tạo biến lỗi
        $errors = [];

        // Kiểm tra trường tên
        if (empty($request->input('name'))) {
            $errors['name'] = 'Tên là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường email
        $email = $request->input('email');
        if (empty($email)) {
            $errors['email'] = 'Email là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (client_users::where('email', $email)->exists()) {
            $errors['email'] = 'Email đã tồn tại';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường mật khẩu
        $password = $request->input('password');
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường xác nhận mật khẩu
        $passwordConfirmation = $request->input('password_confirmation');
        if (empty($passwordConfirmation)) {
            $errors['password_confirmation'] = 'Bạn cần xác nhận lại mật khẩu';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        elseif ($password !== $passwordConfirmation) {
            $errors['password_confirmation'] = 'Mật khẩu xác nhận không khớp';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường đồng ý với điều khoản
        if (!$request->has('terms')) {
            $errors['terms'] = 'Bạn phải đồng ý với Điều Khoản Dịch Vụ và Chính Sách Bảo Mật.';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Nếu không có lỗi, lưu người dùng
        $user = new client_users();
        $user->name = $request->input('name');
        $user->password = $password;
        $user->email = $email;
        $user->save();

        return redirect('/authentic/cli_login');
    }

    public function show_cli_forgetpw(){
        return view('authentic.cli_forgetpw',[
            'title' => 'Quên mật khẩu'
        ]);
    }

    public function edit_cli_pass(Request $request)
    {
        // Khởi tạo biến lỗi
        $errors = [];

        // Kiểm tra trường email
        $email = $request->input('email');
        if (empty($email)) {
            $errors['email'] = 'Email là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (!client_users::where('email', $email)->exists()) {
            $errors['email'] = 'Email không tồn tại';
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Kiểm tra trường mật khẩu
        $password = $request->input('password');
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu là bắt buộc';
            return redirect()->back()->withErrors($errors)->withInput();
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        
        // Kiểm tra trường xác nhận mật khẩu
        $passwordConfirmation = $request->input('password_confirmation');
        if (empty($passwordConfirmation)) {
            $errors['password_confirmation'] = 'Bạn cần xác nhận lại mật khẩu';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        elseif ($password !== $passwordConfirmation) {
            $errors['password_confirmation'] = 'Mật khẩu xác nhận không khớp';
            return redirect()->back()->withErrors($errors)->withInput();
        }


        // Cập nhật mật khẩu
        $user = DB::table('client_users')->where('email', $email)->first();
        
        if ($user) {
            DB::table('client_users')->where('email', $email)->update([
                'password' => $password
            ]);

            return redirect('/authentic/cli_login');
        }
    }
}
