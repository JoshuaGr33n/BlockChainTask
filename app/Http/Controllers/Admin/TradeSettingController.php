<?php
namespace App\Http\Controllers\Admin;

use App\Trade;
use App\GeneralSetting;
use App\Currency;
use App\SupportAttachment;
use App\Trx;
use App\User;
use App\UserWallet;
use App\Http\Controllers\Controller;
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


class TradeSettingController extends Controller
{


    public function successfulbuy()
    {
        $page_title = 'Successful Purchase';
        $currency = Currency::where('status', '!=', 0)->whereCanbuy(1)->orderBy('name','asc')->get();
        $trade = Trade::whereType(1)->where('status', 1)->get();
        return view('admin.trade.buy', compact('page_title','currency','trade'));
    }
    public function pendingbuy()
    {
        $page_title = 'Pending Purchase';
        $currency = Currency::where('status', '!=', 0)->whereCanbuy(1)->orderBy('name','asc')->get();
        $trade = Trade::whereType(1)->where('status', 0)->get();
        return view('admin.trade.buy', compact('page_title','currency','trade'));
    }
    public function declinedbuy()
    {
        $page_title = 'Declined Purchase';
        $currency = Currency::where('status', '!=', 0)->whereCanbuy(1)->orderBy('name','asc')->get();
        $trade = Trade::whereType(1)->where('status', 2)->get();
        return view('admin.trade.buy', compact('page_title','currency','trade'));

    }

     public function approvebuy($id)
    {
        $trade = Trade::whereTrx($id)->first();
        if(!$trade){
         $notify[] = ['error', 'Trade not found'];
            return back()->withNotify($notify);
        }

         else{
         $trade->status  = 1;
         $trade->save();

        $user = User::whereId($trade->user_id)->first();
        $currency = Currency::whereId($trade->currency_id)->first();
        if($user){
        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $user->username;
        $subject = 'Transaction Approved';
        $message = 'Your Pending Purchase Order with transaction number '.$trade->trx.' has been approved and '.$trade->amount.' worth of '.$currency->name.' has been paid into your wallet address ';

        try {
            send_general_email($user->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }
        }


         $notify[] = ['success', 'Trade Approved Successfully'];
            return back()->withNotify($notify);
         }

    }

     public function declinebuy($id)
    {
         $trade = Trade::whereTrx($id)->first();
        if(!$trade){
         $notify[] = ['error', 'Trade not found'];
            return back()->withNotify($notify);
        }

         else{
         $trade->status  = 2;
         $trade->save();

          $user = User::whereId($trade->user_id)->first();
        $currency = Currency::whereId($trade->currency_id)->first();
        if($user){
        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $user->username;
        $subject = 'Transaction Declined';
        $message = 'Your Pending Purchase Order with transaction number '.$trade->trx.' has been declined for possible violation of terms or incomplete transaction. Contact support if not clear ';

        try {
            send_general_email($user->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }
        }
          $notify[] = ['success', 'Trade Declined Successfully'];
            return back()->withNotify($notify);
         }

    }

     public function viewbuy($id)
    {
         $trade = Trade::whereTrx($id)->first();
        if(!$trade){
         $notify[] = ['error', 'Trade not found'];
            return back()->withNotify($notify);
        }

         else{
         $page_title = 'View '.$id.' Trade';
        return view('admin.trade.buy-view', compact('page_title','trade'));
         }

    }


    public function successfulsell()
    {
        $page_title = 'Successful Sales';
        $currency = Currency::where('status', '!=', 0)->whereCansell(1)->orderBy('name','asc')->get();
        $trade = Trade::whereType(2)->where('status', 2)->get();
        return view('admin.trade.sell', compact('page_title','currency','trade'));
    }
    public function pendingsell()
    {
        $page_title = 'Pending Sales';
        $currency = Currency::where('status', '!=', 0)->whereCansell(1)->orderBy('name','asc')->get();
        $trade = Trade::whereType(2)->where('status', 1)->get();
        return view('admin.trade.sell', compact('page_title','currency','trade'));
    }
    public function declinedsell()
    {
        $page_title = 'Declined Sales';
        $currency = Currency::where('status', '!=', 0)->whereCansell(1)->orderBy('name','asc')->get();
        $trade = Trade::whereType(2)->where('status', 3)->get();
        return view('admin.trade.sell', compact('page_title','currency','trade'));

    }

     public function approvesell($id)
    {
        $trade = Trade::whereTrx($id)->first();
        if(!$trade){
         $notify[] = ['error', 'Trade not found'];
            return back()->withNotify($notify);
        }

         else{
         $trade->status  = 2;
         $trade->save();

        $user = User::whereId($trade->user_id)->first();
        $wallet = UserWallet::whereUser_id($trade->user_id)->whereType('deposit_wallet')->first();
        if($wallet){
        $wallet->balance += $trade->main_amo;
        $wallet->save();
        }
        $currency = Currency::whereId($trade->currency_id)->first();
        if($user){
        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $user->username;
        $subject = 'Transaction Approved';
        $message = 'Your Pending Sell Order with transaction number '.$trade->trx.' has been approved and '.$trade->main_amo.' has been paid into your fiat wallet ';

        try {
            send_general_email($user->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }
        }


         $notify[] = ['success', 'Trade Approved Successfully'];
            return back()->withNotify($notify);
         }

    }

     public function declinesell($id)
    {
         $trade = Trade::whereTrx($id)->first();
        if(!$trade){
         $notify[] = ['error', 'Trade not found'];
            return back()->withNotify($notify);
        }

         else{
         $trade->status  = 3;
         $trade->save();

          $user = User::whereId($trade->user_id)->first();
        $currency = Currency::whereId($trade->currency_id)->first();
        if($user){
        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $user->username;
        $subject = 'Transaction Declined';
        $message = 'Your Pending sell Order with transaction number '.$trade->trx.' has been declined for possible violation of terms or incomplete transaction. Contact support if not clear ';

        try {
            send_general_email($user->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }
        }
          $notify[] = ['success', 'Trade Declined Successfully'];
            return back()->withNotify($notify);
         }

    }

     public function viewsell($id)
    {
         $trade = Trade::whereTrx($id)->first();
        if(!$trade){
         $notify[] = ['error', 'Trade not found'];
            return back()->withNotify($notify);
        }

         else{
         $page_title = 'View '.$id.' Trade';
        return view('admin.trade.sell-view', compact('page_title','trade'));
         }

    }

        public function validatesell($id)
    {

        $general = GeneralSetting::first();
        $trade = Trade::where('trx', $id)->first();
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
         $notify[] = ['error', 'This Transaction Has Expired. It appeared that user didnt send any bitcoin before transaction expired'];
            return back()->withNotify($notify);
        }
        if($reply['data']['status'] == "Pending"){
          $notify[] = ['error', 'You have not received any payment yet on this transaction'];
            return back()->withNotify($notify);

        }

        $status = $reply['data']['status_code'];

        if($status==0){
         $notify[] = ['error', 'We have not received your payment. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);
        }




           if($status==1 || $status==3){
          $notify[] = ['success', 'User has successfully made payment on this transaction'];
            return back()->withNotify($notify);


        }

    }





}
