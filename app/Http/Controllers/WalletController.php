<?php

namespace App\Http\Controllers;

use App\CommissionLog;
use App\Cryptotrx;
use App\Trade;
use App\GeneralSetting;
use App\Currency;
use App\Lib\GoogleAuthenticator;
use App\Cryptowallet;
use App\SupportAttachment;
use App\SupportMessage;
use App\SupportTicket;
use App\TimeSetting;
use App\Trx;
use App\User;
use App\UserWallet;
use App\Cryptowithdraw;
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


class WalletController extends Controller
{


    public function wallet($id)
    {
        $currency = Currency::where('status', '!=', 0)->whereCanwallet(1)->whereSymbol($id)->first();
        $wallets = Cryptowallet::where('user_id', auth()->id())->whereStatus(1)->whereCoin_id($currency->id)->get();
        $unit = Cryptowallet::where('user_id', auth()->id())->whereStatus(1)->whereCoin_id($currency->id)->sum('balance');
        $page_title = $currency->name.' Wallet';

        $general = GeneralSetting::first();
        $baseurl = "https://coinremitter.com/api/v3/get-coin-rate";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'fiat_amount' => 1,'fiat_symbol' => 'USD'),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		//return $response;

		if (!isset($reply['msg'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['msg'] != 'success'){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         $rate = $reply['data'][$currency->symbol]['price'];
         $usd = $rate * $unit;
         foreach ($wallets as $dataw)
        {
         $usdrate = $rate * $dataw->balance;
         $dataw->usd = $usdrate;
         $dataw->save();
        }

        return view('user.wallets.wallet', compact('page_title','currency','wallets','unit','rate','usd'));
      }

       public function createwallet(Request $request, $id)
       {
        $this->validate($request, [
            'label' => 'required|max:10',
        ]);
        $page_title = 'Create Wallet';
        $currency = Currency::where('status', '!=', 0)->whereCanwallet(1)->whereSymbol($id)->first();
        $walletcount = Cryptowallet::where('user_id', auth()->id())->whereCoin_id($currency->id)->whereLabel($request->label)->where('status', 1)->count();
        if($walletcount > 0){
         $notify[] = ['error', 'You already have a '.$currency->name.' wallet with this label. Please try another label'];
            return back()->withNotify($notify);
        }
        $general = GeneralSetting::first();
        $label = $request->label;;
        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-new-address";
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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'label' => $label),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		//return $response;

		 if (!isset($reply['flag'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['flag'] != '1'){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         $address = $reply['data']['address'];
         $qrcode = $reply['data']['qr_code'];

         $w['user_id'] = Auth::id();
         $w['address'] = $address;
         $w['qrcode'] = $qrcode;
         $w['coin_id'] = $currency->id;
         $w['label'] = $label;
         $w['balance'] = 0;
         $w['status'] = 1;
         $result = Cryptowallet::create($w);

         if($result){
         $notify[] = ['success', 'Your new '.$currency->name.' wallet has been created successfully.'];
         return back()->withNotify($notify);
            }


    }

      public function sendfromwallet(Request $request,$id)
    {
        $this->validate($request, [
            'wallet' => 'required',
            'currency' => 'required',
            'amount' => 'required|numeric'
        ]);
        $currency = Currency::where('id', $request->currency)->where('status', 1)->whereCanwallet(1)->first();
         if(!$currency){
         $notify[] = ['error', 'Invalid Currency or Currency Not Found'];
            return back()->withNotify($notify);
        }

        $wallet = Cryptowallet::where('user_id', auth()->id())->where('id', $id)->whereCoin_id($currency->id)->where('status', 1)->first();

        if(!$wallet){
         $notify[] = ['error', 'Invalid Wallet'];
            return back()->withNotify($notify);
        }

        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-fiat-to-crypto-rate";
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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'fiat_amount' => $request->amount,'fiat_symbol' => 'USD'),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);

		return $response;

		if (!isset($reply['msg'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['flag'] != '1'){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         $unit = $reply['data']['crypto_amount'];

        if ($wallet < $unit) {
            $notify[] = ['error', 'You do not have enough fund in your wallet to send.'];
            return back()->withNotify($notify);
        }

        else {
        $trx = getTrx();
        $general = GeneralSetting::first();
        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/validate-address";
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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'address' => $request->wallet),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		//return $response;

		if (!isset($reply['msg'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['flag'] != '1'){
		 $notify[] = ['error', 'Invalid '.$currency->name.' Wallet Address'];
            return back()->withNotify($notify);
         }

          if ($reply['flag'] = '1'){
          $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/withdraw";
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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'to_address' => $request->wallet,'amount' => $unit),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);

		//return $reply;

		if (!isset($reply['msg'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['flag'] != '1'){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
          if ($reply['flag'] == '1'){

            $w['user_id'] = Auth::id();
            $w['coin_id'] = $currency->id;
            $w['amount'] = $unit;
            $w['to_address'] = $reply['data']['to_address'];
            $w['usd'] = $request->amount;
            $w['address'] = $wallet->address;
            $w['type'] = 'send';
            $w['hash'] = $reply['data']['txid'];
            $w['trxid'] = $reply['data']['id'];
            $w['explorer_url'] = $reply['data']['explorer_url'];
            $w['wallet_id'] = $reply['data']['wallet_id'];
            $w['status'] = 1;
            $result = Cryptotrx::create($w);


            $fee = $currency->fee/100;
            $charge = $fee*$unit;
            $total = $charge + $reply['data']['total_amount'];
            $wallet->balance = $wallet->balance - $total;
            $wallet->save();

            if($result){
            $notify[] = ['success', 'You have successfully sent '.$currency->name.' to the wallet address.'];
            return back()->withNotify($notify);
            }
          }

          }

        }
    }

      public function viewwallet($id)
    {
        $page_title = 'View Asset';
        $wallet = Cryptowallet::where('user_id', auth()->id())->where('address', $id)->where('status', 1)->first();
         if(!$wallet){
         $notify[] = ['error', 'Invalid Wallet or Wallet Not Found'];
            return back()->withNotify($notify);
         }
        $currency = Currency::where('id', $wallet->coin_id)->where('status', 1)->whereCanwallet(1)->first();
         if(!$currency){
         $notify[] = ['error', 'Invalid Currency or Currency Not Found'];
            return back()->withNotify($notify);
         }

          $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-transaction-by-address";
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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'address' => $wallet->address),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		//return $response;

         $general = GeneralSetting::first();
         $sent = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->where('type', 'send')->get();
         $received = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->whereType('receive')->get();
         //$trx = $reply['data'];
         $tsent = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->where('type', 'send')->sum('usd');
         $tsentunit = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->where('type', 'send')->sum('amount');
         $trec = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->whereType('receive')->sum('usd');
         $trecunit = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->whereType('receive')->sum('amount');
         $total = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->sum('usd');
         $totalunit = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->sum('amount');
        return view('user.wallets.view-wallet', compact('page_title','currency','sent','wallet','received','tsent','trec','tsentunit','trecunit','total','totalunit'));
    }








}
