<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\UserLogin;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Carbon\Carbon;
use Auth;



class CustomLoginController extends Controller
{
    protected $redirectTo = '/user/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|min:5'
        ]);
        if($validator->fails()) {
            $validator->errors()->add('errors', 'true');
            return response()->json($validator->errors());
        }


        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            $result['success'] = true;
            $result['url'] = Redirect::intended(route('user.home'));;
        } else {
            $result['errors'] = true;
        }
        return response($request);

    }


}
