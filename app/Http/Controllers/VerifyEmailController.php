<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    public function sendEmailVerificationNotification(Request $request)
    {
        // Mail::to(Auth::user())->send(new VerifyEmail(Auth::user()));
        // $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email xác thực đã được gửi']);
    }

    public function verifyEmail(Request $request)
    {
        if($request->user()->id != $request->id){
            return response()->json(['message' => 'Vui lòng đăng nhập tài khoản chính xác để xác thực'], 401);
        }

        if ($request->user()->email_verified_at) {
            return response()->json(['message' => 'Email đã được xác thực']);
        }
        $request->user()->forceFill([
            'email_verified_at' => now(),
        ])->save();
        return response()->json(['message' => 'Xác thực email thành công']);

    }
}
