<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Frontend;
use App\Gateway;
use App\GeneralSetting;
use App\Invest;
use App\Language;
use App\Plan;
use App\Subscriber;
use App\Cryptoffer;
use App\TimeSetting;
use App\User;
use App\UserWallet;
use App\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function __construct()
    {

    }
    public function home()
    {
        $basic = GeneralSetting::first();


        $data['totalWithdraw'] = Withdrawal::whereIn('status', [1])->sum('amount');
        $data['totalDeposit'] = Deposit::where('status', 1)->sum('amount');
        $data['totalAccounts'] = User::count();
        $data['page_title'] = 'Home';
        $data['set'] = GeneralSetting::first();
        $data['offer'] = Cryptoffer::whereStatus(1)->paginate(10);

        $data['plans'] = Plan::where('status', 1)->where('featured', 1)->latest()->get();
        $data['wallets'] = UserWallet::where('user_id', Auth::id())->get();
        $data['latestDeposit'] = Deposit::with('user', 'gateway')->where('status', 1)->latest()->limit(5)->get();
        $data['latestWithdraw'] = Withdrawal::with('user', 'method')->where('status', 1)->latest()->limit(5)->get();


        $data['testimonialCaption'] = Frontend::where('data_keys', 'testimonial.caption')->first();
        $data['testimonial'] = Frontend::where('data_keys', 'testimonial')->latest()->get();


        $data['blogCaption'] = Frontend::where('data_keys', 'blog.caption')->first();
        $data['blogs'] = Frontend::where('data_keys', 'blog.post')->latest()->limit(3)->get();
        $data['weAccept'] = Gateway::where('status', '1')->get();


            $data['homeContent'] = Frontend::where('data_keys', 'homecontent')->first();

            $data['investedInPitches'] = Invest::sum('amount');
            $data['averageInvest'] = Invest::avg('amount');
            $data['registerMember'] = User::count();
            $data['about'] = Frontend::where('data_keys', 'about.minimul')->firstOrFail();
            $data['homeContent'] = Frontend::where('data_keys', 'homecontent2')->first();

            $data['profitCaption'] = Frontend::where('data_keys', 'profit.caption')->first();
            $data['profits'] = Frontend::where('data_keys', 'profit')->get();

            $data['featureCaption'] = Frontend::where('data_keys', 'feature.caption')->first();
            $data['features'] = Frontend::where('data_keys', 'feature')->get();
            $data['services'] = Frontend::where('data_keys', 'services')->get();
            $data['planList'] = Plan::where('status', 1)->latest()->get();




        return view('front.home', $data);
    }


    public function about()
    {
        $data['page_title'] = "ABOUT US";
         $data['set'] = GeneralSetting::first();
        $data['about'] = Frontend::where('data_keys', 'about.minimul')->firstOrFail();

        $data['testimonialCaption'] = Frontend::where('data_keys', 'testimonial.caption')->first();
        $data['testimonial'] = Frontend::where('data_keys', 'testimonial')->latest()->get();


        $data['blogCaption'] = Frontend::where('data_keys', 'blog.caption')->first();
        $data['blogs'] = Frontend::where('data_keys', 'blog.post')->latest()->limit(3)->get();
        $data['services'] = Frontend::where('data_keys', 'services')->get();

        $data['weAccept'] = Gateway::where('status', '1')->get();

             return view('front.about', $data);
    }

    public function faq()
    {
        $data['page_title'] = "FAQ";
        $data['faqs']  = Frontend::where('data_keys', 'faq')->get();
        return view('front.faq', $data);

    }

    public function rules()
    {
        $data['page_title']  = "Terms & Condition";
       $data['rules']  = Frontend::where('data_keys', 'rules')->get();
       return view('front.terms', $data);
    }


    public function policyInfo($id, $slug = null)
    {
        $menu = Frontend::where('data_keys', 'company_policy')->where('id', $id)->firstOrFail();
        $page_title = $menu->value->title;
        return view('front.policy', compact('menu', 'page_title'));
    }


    public function contact()
    {
        $data['page_title'] = "Contact Us";
        $data['contact'] = Frontend::where('data_keys', 'contact')->firstOrFail();
        return view('front.contact', $data);
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|string|email',
            'message' => 'required',
            'subject' => 'required'
        ]);
        $subject = $request->subject;
        $txt = "<br><br>" . $request->message;
        $txt .= "<br><br>" . "Contact Number : " . $request->phone . "<br>";
        send_contact($request->email, $request->name, $subject, $txt);
        $notify[] = ['success', 'Contact Message Send'];
        return back()->withNotify($notify);
    }

    public function register($reference)
    {
        $page_title = "Sign Up";
        return view('auth.register', compact('reference', 'page_title'));
    }

    public function plan()
    {
        $data['page_title'] = "Investment Plan";
        $data['plans'] = Plan::where('status', 1)->latest()->get();
        $data['wallets'] = UserWallet::where('user_id', Auth::id())->get();
        return view(activeTemplate() . 'plan', $data);
    }


    public function blog()
    {
         $data['blogs'] = Frontend::where('data_keys', 'blog.post')->latest()->paginate(5);
         $data['recentBlog'] = Frontend::where('data_keys', 'blog.post')->latest()->limit(4)->get();
         $data['page_title'] = "Blog";
        return view('front.blog', $data);
    }

    public function blogDetails($slug = null, $id, $data_keys = 'blog.post')
    {
        $post = Frontend::where('id', $id)->where('data_keys', $data_keys)->firstOrFail();


        $page_title = "Blog Details";
        $data['title'] = $post->value->title;
        $data['details'] = $post->value->body;
        $data['image'] = config('constants.frontend.blog.post.path') . '/' . $post->value->image;
        $recentBlog = Frontend::where('data_keys', 'blog.post')->latest()->limit(4)->get();
        return view('front.blog-details', compact('recentBlog', 'post', 'data', 'page_title'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $macCount = Subscriber::where('email', trim(strtolower($request->email)))->count();
        if ($macCount > 0) {
            $notify[] = ['error', 'You have already subscribed.'];
        return back()->withNotify($notify);

        } else {
            Subscriber::create($request->only('email'));
             $notify[] = ['success', 'Subscribed Successfully.'];
        return back()->withNotify($notify);

        }
    }


    public function changeLang($lang)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }


    public function planCalculator(Request $request)
    {

        if ($request->planId == null) {
            return response(['errors'=> 'Please Select a Plan!']);
        }

        $requestAmount = $request->investInput;
        if ($requestAmount == null ||  0 > $requestAmount) {
            return response(['errors'=> 'Please Enter Invest Amount!']);
        }


        $gnl = GeneralSetting::first();


        $plan = Plan::where('id', $request->planId)->where('status', 1)->first();
        if (!$plan) {
            return response(['errors'=> 'Invalid Plan!']);
        }

        if ($plan->fixed_amount == '0') {
            if ($requestAmount < $plan->minimum) {
                return response(['errors'=> 'Minimum Invest ' . formatter_money($plan->minimum) . ' ' . $gnl->cur_text]);
            }
            if ($requestAmount > $plan->maximum) {
                return response(['errors'=> 'Maximum Invest ' . formatter_money($plan->maximum) . ' ' . $gnl->cur_text]);
            }
        } else {
            if ($requestAmount != $plan->fixed_amount) {
                return response(['errors'=> 'Fixed Invest amount ' . formatter_money($plan->fixed_amount) . ' ' . $gnl->cur_text]);
            }
        }


        //start
        if ($plan->interest_status == 1) {
            $interest_amount = ($requestAmount * $plan->interest) / 100;
            $result['interest_amount'] = $interest_amount . "%";
        } else {
            $interest_amount = $plan->interest;
            $result['interest_amount'] = $interest_amount . " ".$gnl->cur_text;
        }

        $period = ($plan->lifetime_status == 1) ? '-1' : $plan->repeat_time;


        if($plan->lifetime_status == '0'){
            $result['interestValidity'] =  'Per '. $plan->times . ' Hours, '. $plan->repeat_time. " Times";
        }else{
            $result['interestValidity'] =  'Per '. $plan->times . " Hours,  Lifetime";
        }

        return response($result);
        //end



    }


}
