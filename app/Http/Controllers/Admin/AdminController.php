<?php

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\Referral;
use App\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\UserLogin;
use App\Cryptoescrow;
use App\Withdrawal;

class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        $page_title = 'Dashboard';
        $user_login_data = UserLogin::whereYear('created_at', '>=', \Carbon\Carbon::now()->subYear())->get(['browser', 'os', 'country']);
        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });

        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });

        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);

        $widget['total_users'] = User::all('sv', 'ev', 'status');

        $widget['users_wallets'] = UserWallet::selectRaw("type, SUM(balance) as amo")->groupBy('type')->get();
        $widget['escrow'] = Cryptoescrow::whereStatus(0)->sum('amount');
        $widget['escrows'] = Cryptoescrow::whereStatus(1)->sum('amount');

        $widget['deposits'] = Deposit::where('status', 1)
            ->selectRaw('COUNT(*) as total, SUM(rate * charge) as total_charge')
            ->selectRaw('SUM(rate * amount) as total_amount')
            ->first();

        $widget['withdrawals'] = Withdrawal::where('status', 1)
            ->selectRaw('COUNT(*) as total, SUM(rate * charge) as total_charge')
            ->selectRaw('SUM(rate * amount) as total_amount')
            ->first();

        return view('admin.dashboard', compact('page_title', 'chart', 'widget'));
    }

    public function profile()
    {
        $page_title = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('page_title', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $user = Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = upload_image($request->image, config('constants.admin.profile.path'), config('contants.admin.profile.size'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('admin.profile')->withNotify($notify);
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password Do not match !!'];
            return back()->withErrors(['Invalid old password.']);
        }
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.profile')->withSuccess('Password Changed Successfully');
    }


    public function refIndex()
    {
        $page_title = 'Manage Referral';
        $trans = Referral::get();
        return view('admin.refer',compact('page_title', 'trans'));

    }
    public function refStore(Request $request)
    {
        $this->validate($request, [
            'level*' => 'required|integer|min:1',
            'percent*' => 'required|numeric',
        ]);

        Referral::truncate();

        for ($a = 0; $a < count($request->level); $a++){
            Referral::create([
                'level' => $request->level[$a],
                'percent' => $request->percent[$a],
                'status' => 1,
            ]);
        }

        $notify[] = ['success', 'Create Successfully'];
        return back()->withNotify($notify);

    }

}
