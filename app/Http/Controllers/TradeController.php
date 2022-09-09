<?php

namespace App\Http\Controllers;

use App\CommissionLog;
use App\ContactTopic;
use App\Trade;
use App\GeneralSetting;
use App\Currency;
use App\Lib\GoogleAuthenticator;
use App\Plan;
use App\SupportAttachment;
use App\SupportMessage;
use App\SupportTicket;
use App\TimeSetting;
use App\Trx;
use App\User;
use App\UserWallet;
use App\Withdrawal;
use App\WithdrawMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;
use File;
use Validator;
use Session;


class TradeController extends Controller
{


    public function buy()
    {
        $page_title = 'Buy Digital Asset';
        $currency = Currency::where('status', '!=', 0)->whereCanbuy(1)->orderBy('name','asc')->get();
        $authWallets = UserWallet::where('user_id', auth()->id())->get();
        $trade = Trade::whereType(1)->where('user_id', auth()->id())->get();
        return view('user.trade.buy', compact('page_title','currency','authWallets','trade'));
    }

     public function buycoin(Request $request)
    {
        $this->validate($request, [
            'currency' => 'required',
            'payment_method' => 'required',
            'wallet' => 'required',
            'confirm_wallet' => 'required',
            'amount' => 'required|numeric'
        ]);
        $currency = Currency::where('id', $request->currency)->where('status', 1)->whereCanbuy(1)->firstOrFail();
        if(!$currency){
         $notify[] = ['error', 'Currency Not Found'];
            return back()->withNotify($notify);
        }
        $authWallet = UserWallet::where('type', $request->payment_method)->where('user_id', Auth::id())->first();
        if(!$authWallet){
         $notify[] = ['error', 'Payment Method Not Valid'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $currency->min) {
            $notify[] = ['error', 'Your Request Amount is Smaller The Purchase Minimum Amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $currency->max) {
            $notify[] = ['error', 'Your Request Amount is Larger Then Purchase Maximum Amount.'];
            return back()->withNotify($notify);
        }

         if ($request->wallet != $request->confirm_wallet) {
            $notify[] = ['error', 'Please ensure you have entered same wallet address twice.'];
            return back()->withNotify($notify);
        }

        $pay = $currency->buy*$request->amount;

        if ($request->pay > $authWallet->balance) {
            $notify[] = ['error', 'Your Dont Have Sufficient Balance To Make This Purchase.'];
            return back()->withNotify($notify);
        } else {

            $authWallet->balance = $authWallet->balance - $pay;
            $authWallet->save();

            $w['user_id'] = Auth::id();
            $w['amount'] = $request->amount; // User Wallet ID
            $w['main_amo'] = $pay;
            $w['type'] = 1;
            $w['currency_id'] = $currency->id;
            $w['wallet'] = $request->wallet;
            $w['method'] = $request->payment_method;
            $w['rate'] = $currency->buy;
            $w['price'] = $currency->price;
            $w['getamo'] = $request->amount/$currency->price;
            $w['trx'] = getTrx();
            $w['status'] = 0;
            $result = Trade::create($w);

             $notify[] = ['success', 'Your purchase was succcessful'];
            return back()->withNotify($notify);
        }
    }

     public function sell()
    {
        $page_title = 'Sell Digital Asset';
        $currency = Currency::where('status', '!=', 0)->whereCansell(1)->orderBy('name','asc')->get();
        $authWallets = UserWallet::where('user_id', auth()->id())->get();
        $trade = Trade::whereType(2)->where('user_id', auth()->id())->get();
        return view('user.trade.sell', compact('page_title','currency','authWallets','trade'));
    }

      public function sellcoin(Request $request)
    {
        $this->validate($request, [
            'currency' => 'required',
            'amount' => 'required|numeric'
        ]);
        $currency = Currency::where('id', $request->currency)->whereCansell(1)->where('status', 1)->firstOrFail();
        if(!$currency){
         $notify[] = ['error', 'Currency Not Found'];
            return back()->withNotify($notify);
        }

        if ($request->amount < $currency->min) {
            $notify[] = ['error', 'Your Request Amount is Smaller The Purchase Minimum Amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $currency->max) {
            $notify[] = ['error', 'Your Request Amount is Larger Then Purchase Maximum Amount.'];
            return back()->withNotify($notify);
        }

        else {
        $trx = getTrx();
        $general = GeneralSetting::first();
        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/create-invoice";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'amount' => $request->amount,'name' => $trx,'currency' => 'USD','expire_time' => $general->timeout, 'suceess_url' => url("/api/coinremittersuccesscallback")),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
        //return $reply;
		if (!isset($reply['flag'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);

        }
        
        if ($reply['flag'] != 1){
		$notify[] = ['error', $reply['msg'] ];
        return back()->withNotify($notify);
        }

		$address = $reply['data']['address'];
		$invoiceid = $reply['data']['invoice_id'];
		$coinvalue = $reply['data']['total_amount'][$currency->symbol];
        $now = Carbon::now();



            $pay = $currency->sell*$request->amount;

            $w['coin_amo'] = $coinvalue;
	        $w['coin_wallet'] = $address;
	        $w['invoiceid'] = $invoiceid;
            $w['timeout'] = Carbon::parse($now)->addMinutes($general->timeout);

            $w['user_id'] = Auth::id();
            $w['amount'] = $request->amount; // User Wallet ID
            $w['main_amo'] = $pay;
            $w['type'] = 2;
            $w['currency_id'] = $currency->id;
            $w['wallet'] = $request->wallet;
            $w['method'] = $request->payment_method;
            $w['rate'] = $currency->sell;
            $w['price'] = $currency->price;
            $w['getamo'] = $request->amount/$currency->price;
            $w['trx'] = $trx;
            $w['status'] = 0;
            $result = Trade::create($w);

            Session::put('Track', $trx);
            return redirect()->route('user.sendcoin');
        }
    }

      public function sendcoin()
    {
        $page_title = 'Sell Digital Asset';
        $track = Session::get('Track');
        $trade = Trade::whereType(2)->where('user_id', auth()->id())->whereTrx($track)->first();
        $assets = Currency::where('status', '!=', 0)->orderBy('name','asc')->get();
        $currency = Currency::where('status', '!=', 0)->whereId($trade->currency_id)->orderBy('name','asc')->first();
        return view('user.trade.send', compact('page_title','currency','trade','assets'));
    }

       public function validatesell(Request $request)
    {

        $general = GeneralSetting::first();
        $trade = Trade::where('trx', $request->trx)->first();
         if(!$trade){
          $notify[] = ['error', 'Invalid Transaction'];
            return back()->withNotify($notify);
        }

        $currency = Currency::where('id', $trade->currency_id)->first();

        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-invoice";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'invoice_id' => $trade->invoiceid),
		));

        $response = curl_exec($curl);
        //return $response;
        $reply = json_decode($response,true);
        curl_close($curl);

        //return $reply['data']['status_code'];

        if (!isset($reply['data']['status_code'])){
          $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
        }

        if($reply['data']['status'] == "Expired"){
         $notify[] = ['error', 'This Transaction Has Expired. It appeared that you didnt send any bitcoin before transaction expired'];
            return back()->withNotify($notify);
        }
        if($reply['data']['status'] == "Pending"){
          $notify[] = ['error', 'We have not received your payment. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);

        }

        $status = $reply['data']['status_code'];

        if($status==0){
         $notify[] = ['error', 'We have not received your payment. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);
        }




           if($status==1 || $status==3){
           $authWallet = UserWallet::where('type', 'deposit_wallet')->where('user_id', Auth::id())->first();
           $authWallet->balance = $authWallet->balance + $trade->main_amo;
           $authWallet->save();

           $trade->status= 1;
           $trade->save();
           $notify[] = ['success', 'Transaction Successfull'];
            return redirect()->route('user.sell')->withNotify($notify);


        }

    }






}
