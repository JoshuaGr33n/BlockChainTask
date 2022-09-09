<?php

namespace App\Http\Controllers;

use App\User;
use App\Cryptotrx;
use App\CommissionLog;
use App\GeneralSetting;
use App\Currency;
use App\Lib\GoogleAuthenticator;
use App\Cryptowallet;
use App\Trx;
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
use Illuminate\Support\Str;

class CallbackController extends Controller
{



    public function webhook(Request $request)
    {

        return response(['Message'=>'Wallet Credited'], 200);
        $input = $request->all();
        $u = Cryptowallet::where('address', $input['address'])->first();
        $currency = Currency::whereSymbol($input['coin_short_name'])->first();
        $amount = $input['amount'];

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
		));
		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		$rate = $reply['data'][$currency->symbol]['price'];
        $usd = $rate * $amount;



        if ($u) {
            $receive = Cryptotrx::where('trxid', $input['id'])->whereType('receive')->first();
            //$send = Cryptotrx::where('trxid', $input['id'])->whereType('send')->first();

            if($input['type'] == 'receive')
        {
            if(!$receive)
            {
            $u->balance += $amount;
            $u->save();

            $w['user_id'] = $u->user_id;
            $w['coin_id'] = $u->coin_id;
            $w['amount'] = $input['amount'];
            $w['usd'] = $usd;
            $w['address'] = $input['address'];
            $w['type'] = $input['type'];
            $w['trxid'] = $input['id'];
            $w['hash'] = $input['txid'];
            $w['explorer_url'] = $input['explorer_url'];
            $w['wallet_id'] = $input['wallet_id'];
            $w['status'] = 1;
            $result = Cryptotrx::create($w);
            //return response(['Message'=>'Wallet Credited'], 200);
            }

         }

            return response(['Message'=>'Wallet Credited'], 200);


        }
        elseif(!$us){
            return "Wallet not found";
        }
        else{
            return "Transaction Not Found";
        }
    }

}
