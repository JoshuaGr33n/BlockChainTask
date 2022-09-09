<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSetting;
use App\User;
use App\Http\Controllers\Controller;
use App\UserWallet;
use App\WithdrawMethod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
       
        $this->middleware('regStatus')->except('registrationNotAllowed');
    }

    public function showRegistrationForm($ref = null)
    {
        $page_title = "Sign Up";
        return view('auth.register', compact('page_title'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:160|unique:users',
            'mobile' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|alpha_num|unique:users|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {



        $gnl = GeneralSetting::first();

        if(isset($data['referBy'])){
            $referUser = User::where('username',$data['referBy'])->first();
        }


        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => trim(strtolower($data['email'])),
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'refer' =>  isset($data['referBy']) ?  $referUser->id : null,
            'mobile' => $data['mobile'],
            'address' => [
                'address' => null,
                'state' => null,
                'zip' => null,
                'country' => $data['country'],
                'city' => null,
            ],
            'status' => 1,
            'ev' =>  $gnl->ev ? 0 : 1,
            'sv' =>  $gnl->sv ? 0 : 1,
            'ts' => 0,
            'tv' => 1,
        ]);


        UserWallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'type' => 'deposit_wallet',
        ]);

        UserWallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'type' => 'interest_wallet',
        ]);


        return $user;
    }

    public function registered()
    {
        return redirect()->route('user.home');
    }
}
