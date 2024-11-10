<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function index() {
        return view('auth.verify');
    }

    public function sentLink(Request $request)  {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function resendVerification(Request $request)
    {
        // التأكد من أن المستخدم مسجل الدخول
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home')->with('status', 'Your email is already verified.');
        }

        // إعادة إرسال رابط التحقق
        Auth::user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link has been resent!');
    }

}
