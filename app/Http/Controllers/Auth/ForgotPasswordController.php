<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        $page_title = "Forgot Password";
        return view('auth.passwords.email', compact('page_title'));
    }

    public function sendResetLinkEmail(Request $request)
    {
         $user = User::where('email', $request->email)->first();
        if (!$user) {
            $notify[] = ['error', 'No user found with this email address.'];
            return back()->withNotify($notify);
        }

        PasswordReset::where('email', $user->email)->delete();

        $code = verification_code(6);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $code,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        send_email($user, 'ACCOUNT_RECOVERY_CODE', ['code' => $code]);
        


        $user->ver_code = $code;
        $user->save();

        $page_title = 'Account Recovery';
        $email = $user->email;
        $notify[] = ['success', 'Password reset email sent successfully'];
        return view('auth.passwords.code_verify', compact('page_title', 'email'))->withNotify($notify);
     
    }
    
    public function sent_link($token)
    {

    return view('reset', ['token' => $token]);
    }


    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required', 'email' => 'required']);
        if (PasswordReset::where('token', $request->code)->where('email', $request->email)->count() != 1) {
            $notify[] = ['error', 'Invalid validation code'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_email', $request->email);
        return redirect()->route('user.password.reset', $request->code)->withNotify($notify);
    }
}
