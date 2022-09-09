<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\User;
use App\UserLogin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'logoutGet']);
    }

    public function showLoginForm()
    {
        $page_title = "Sign In";
        return view('auth.login', compact('page_title'));
    }


    public function login(Request $request)
    {


        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

    public function username()
    {
        return 'username';
    }

    protected function validateLogin(Request $request)
    {
        $recaptcha = \App\Plugin::where('act', 'google-recaptcha3')->where('status', 1)->first();
        $validation_rule = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];
        if ($recaptcha) {
            $validation_rule['g-recaptcha-response'] = 'required';
        }
        $request->validate($validation_rule);
    }

    public function logout(Request $request)
    {
        return $this->logoutGet();
    }

    public function logoutGet()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out. We would love to see you again'];
        return redirect()->route('user.login')->withNotify($notify);
    }

    public function redirectToProvider($provider)
    {
        $gnl = GeneralSettings::first();
        if ($provider == 'facebook') {

            Config::set('services.' . $provider, [
                'client_id' => $gnl->fb_client_id,
                'client_secret' => $gnl->fb_client_secret,
                'redirect' => url('/') . 'user/login/facebook/callback',
            ]);

            return Socialite::driver('facebook')->redirect();
        } elseif ($provider == 'google') {

            Config::set('services.' . $provider, [
                'client_id' => $gnl->google_client_id,
                'client_secret' => $gnl->google_client_secret,
                'redirect' => url('/') . 'user/login/google/callback',
            ]);
            return Socialite::driver('google')->redirect();
        } else {
            return back()->with('alert', 'Something Wrong');
        }
    }


    public function handleProviderCallback($provider)
    {

        $gnl = GeneralSettings::first();

        if ($provider == 'facebook') {

            Config::set('services.' . $provider, [
                'client_id' => $gnl->fb_client_id,
                'client_secret' => $gnl->fb_client_secret,
                'redirect' => url('/') . 'user/login/facebook/callback',
            ]);
            $user = Socialite::driver('facebook')->user();
        } elseif ($provider == 'google') {

            Config::set('services.' . $provider, [
                'client_id' => $gnl->google_client_id,
                'client_secret' => $gnl->google_client_secret,
                'redirect' => url('/') . 'user/login/google/callback',
            ]);
            $user = Socialite::driver('google')->user();
        }


        $exist = User::where('provider', $provider)->where('provider_id', $user->id)->first();


        if ($exist) {
            Auth::login($exist);
            return redirect()->route('user.home');
        } else {
            $new = User::create([
                'name' => $user->name,
                'email' => isset($user->email) ? $user->email : $user->id . '@' . $provider,
                'password' => Hash::make($provider),
                'username' => isset($user->email) ? explode('@', $user->email)[0] : $user->id,
                'provider' => $provider,
                'provider_id' => $user->id,
                'status' => 1,
                'balance' => 0,
                'tauth' => 0,
                'tfver' => 1,
                'emailv' =>  1,
                'smsv' =>  1,
            ]);
            Auth::login($new);
            return redirect()->route('user.home');
        }
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->status == 0) {
            $this->guard()->logout();
            return redirect()->route('user.login')->withErrors(['Your account has been deactivated.']);
        }


        $user = auth()->user();
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();

          $baseUrl = "http://www.geoplugin.net/";
			$endpoint = "json.gp?ip=" . request()->ip()."";
			$httpVerb = "GET";
			$contentType = "application/json"; //e.g charset=utf-8
			$headers = array (
				"Content-Type: $contentType",

        );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $content = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);


             $conti = $content['geoplugin_continentName'];
             $country = $content['geoplugin_countryName'];
             $city = $content['geoplugin_city'];
            $area = $content['geoplugin_areaCode'];
           $code = $content['geoplugin_countryCode'];
            $long = $content['geoplugin_longitude'];
             $lat = $content['geoplugin_latitude'];

        $info = json_decode(json_encode(getIpInfo()), true);
        $ul['user_id'] = $user->id;
        $ul['user_ip'] =  request()->ip();
        $ul['long'] =  $long;
        $ul['lat'] =  $lat;
        $ul['location'] =  $city . $area . $country . $code;
        $ul['country_code'] = $code;
        $ul['browser'] = $info['browser'];
        $ul['os'] = $info['os_platform'];
        $ul['country'] =  $country;
        UserLogin::create($ul);

        return redirect()->intended(route('user.home'));
    }
}
