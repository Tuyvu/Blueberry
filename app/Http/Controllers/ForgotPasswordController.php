<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Hash;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Xử lý yêu cầu gửi link đặt lại mật khẩu qua email
    public function sendResetLinkEmail(Request $request)
    {
        // dd($request->all());
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
                    dd('email chưa đăng ký');
                    return back()->withErrors(['email' => 'Email này không tồn tại trong hệ thống.']);
                }
        $status = Password::sendResetLink(
            $request->only('email')
        );
        // dd($status);

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Hiển thị form nhập mật khẩu mới sau khi người dùng nhấp vào link đặt lại mật khẩu
    public function showResetForm(Request $request,$token)
    {
        $email = $request->get('email');
        return view('auth.reset-password', compact('token','email'));
    }

    // Xử lý việc đặt lại mật khẩu
    public function reset(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8', // Đảm bảo ít nhất 8 ký tự
                'regex:/[a-z]/', // Chứa ít nhất một chữ cái in thường
                'regex:/[A-Z]/', // Chứa ít nhất một chữ cái in hoa
                'regex:/[0-9]/', // Chứa ít nhất một chữ số
                'regex:/[@$!%*?&#]/', // Chứa ít nhất một ký tự đặc biệt
            ]
        ]);

        $request->merge(['password'=>Hash::make($request->password)]);
        // dd($request->password);
        try {
            User::where('email',$request->email)->update(['password' => $request->password]);
        } catch (\Throwable $th) {
            dd($th);
        }
       return redirect()->route('user.login');
    }
}
