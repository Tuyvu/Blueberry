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
    public function connectemail()
    {
        return view('auth.connect-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email này không tồn tại trong hệ thống.']);
        }
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('connect')->with('status', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }


    public function showResetForm(Request $request,$token)
    {
        $email = $request->get('email');
        return view('auth.reset-password', compact('token','email'));
    }

    public function reset(Request $request)
    {

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
