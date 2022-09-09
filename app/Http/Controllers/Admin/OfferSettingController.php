<?php
namespace App\Http\Controllers\Admin;

use App\Trade;
use App\GeneralSetting;
use App\Currency;
use App\Cryptoffer;
use App\Cryptoescrow;
use App\Cryptotrade;
use App\User;
use App\UserWallet;
use App\Cryptowallet;
use App\Cryptotradechat;
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


class OfferSettingController extends Controller
{


    public function alloffer()
    {
        $page_title = 'All Offers';
        $offer = Cryptoffer::all();
        return view('admin.offer.offer', compact('page_title','offer'));
    }

      public function viewoffer($id)
    {

        $data['offer'] = Cryptoffer::whereCode($id)->orderBy('id','desc')->first();
         if(! $data['offer']){
        $notify[] = ['error', 'Invalid market offer'];
        return back()->withNotify($notify)->withInput();
        }

        $data['coin'] = Currency::where('status', 1)->whereId($data['offer']->coin_id)->orderBy('name','asc')->first();
        $data['page_title'] = "View Market Offer";

        return view('admin.offer.view-offer', $data);
    }

      public function alltrade($id)
    {

        $data['offer'] = Cryptoffer::whereCode($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find market offer'];
        return back()->withNotify($notify)->withInput();
        }
        $data['trx'] = Cryptotrade::whereMarketcode($id)->get();
        $data['usd'] = Cryptotrade::whereMarketcode($id)->sum('amount');
        $data['unit'] = Cryptotrade::whereMarketcode($id)->sum('units');
        $data['count'] = Cryptotrade::whereMarketcode($id)->count();
        $data['get'] = Cryptotrade::whereMarketcode($id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }
        $data['page_title'] = "All Trades";
        return view('admin.offer.trades', $data);


    }


  public function successfultrade($id)
    {

        $data['offer'] = Cryptoffer::whereCode($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find market trade'];
        return back()->withNotify($notify)->withInput();
        }
        $data['trx'] = Cryptotrade::where('marketcode', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('marketcode', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('marketcode', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('marketcode', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('marketcode', $id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }
        $data['page_title'] = "Successful Trades";
        return view('admin.offer.trades', $data);


    }

    public function disputedtrade($id)
    {

        $data['offer'] = Cryptoffer::whereCode($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find market trade'];
        return back()->withNotify($notify)->withInput();
        }
        $data['trx'] = Cryptotrade::where('marketcode', $id)->whereDispute(1)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('marketcode', $id)->whereDispute(1)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('marketcode', $id)->whereDispute(1)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('marketcode', $id)->whereDispute(1)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('marketcode', $id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }
        $data['page_title'] = "Successful Trades";
        return view('admin.offer.trades', $data);


    }
   public function pendingtrade($id)
    {

        $data['offer'] = Cryptoffer::whereCode($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find market trade'];
        return back()->withNotify($notify)->withInput();
        }
        $data['trx'] = Cryptotrade::where('marketcode', $id)->whereStatus(0)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('marketcode', $id)->whereStatus(0)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('marketcode', $id)->whereStatus(0)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('marketcode', $id)->whereStatus(0)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('marketcode', $id)->count();

        if($data['get'] < 1){
        $data['get'] = 1;
        }
        $data['page_title'] = "Pending Trades";
        return view('admin.offer.trades', $data);


    }

     public function paidtrade($id)
    {

        $data['offer'] = Cryptoffer::whereCode($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find market trade'];
        return back()->withNotify($notify)->withInput();
        }
        $data['trx'] = Cryptotrade::where('marketcode', $id)->wherePaid(1)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('marketcode', $id)->wherePaid(1)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('marketcode', $id)->wherePaid(1)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('marketcode', $id)->wherePaid(1)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('marketcode', $id)->count();

        if($data['get'] < 1){
        $data['get'] = 1;
        }
        $data['page_title'] = "User Paid Trades";
        return view('admin.offer.trades', $data);


    }
    
        public function escrowcheck($id)
    {

        $general = GeneralSetting::first();
        $trade = Cryptotrade::where('escrowid', $id)->orderBy('id','desc')->first();
         
        if(!$trade)
         {
          $notify[] = ['error', 'Invalid Transaction'];
            return back()->withNotify($notify);
         }
        
        $currency = Currency::where('id', $trade->coin)->first();

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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'invoice_id' => $trade->escrowid),
		));

        $response = curl_exec($curl);
        //return $response;
        $reply = json_decode($response,true);
        curl_close($curl);

        // return $reply;
        // dd("Testingme",$reply);

        if (!isset($reply['data']['status_code'])){
          $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
        }

        if($reply['data']['status'] == "Expired"){
         $notify[] = ['error', 'This Transaction Has Expired. It appeared that seller didnt send any bitcoin before transaction expired'];
            return back()->withNotify($notify);
        }
        if($reply['data']['status'] == "Pending"){
          $notify[] = ['error', 'You have nor received any payment into the escrow wallet'];
            return back()->withNotify($notify);

        }

        $status = $reply['data']['status_code'];

        if($status==0){
         $notify[] = ['error', 'you have not received your payment yet. Kindly tell sellet to Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);
        }
        
        return $reply['data']['status'] ;
        
        

    }



         public function tradeapprove($id)
    {
        $trade = Cryptotrade::where('trx', $id)->orderBy('id','desc')->first();
        $escrow = Cryptoescrow::whereTrade_code($trade->trx)->orderBy('id','desc')->first();
        $wallet = Cryptowallet::where('address',$trade->wallet)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }
        if(!$escrow){
        $notify[] = ['error', 'No money fund in escrow or escrow account not found'];
        return back()->withNotify($notify)->withInput();
        }
    
// dd("testing");
     if(!$wallet){
        $notify[] = ['error', 'Invalid buyer wallet or wallet address not found'];
        return back()->withNotify($notify)->withInput();
        }

        
        $trade->status = 1;
        $trade->disbursed = 1;
        $trade->dispute = 0;
        $trade->save();

        //$wallet->balance += $escrow->amount;
        //$wallet->save();

        $escrow->status = 1;
        $escrow->save();

        $user = User::whereId($trade->buyer)->first();
        $currency = Currency::whereId($trade->coin)->first();
        if($user){
        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $user->username;
        $subject = 'Transaction Approved';
        $message = 'Your Pending Transaction Order with transaction number '.$trade->trx.' has been approved and '.$trade->main_amo.' has been paid into your '.$currency->name.' wallet ';

        try {
            send_general_email($user->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }
      }

        $notify[] = ['success', 'You have approved this trade, Coin disbursed to user'];
        return back()->withNotify($notify)->withInput();

    }


         public function tradedelete($id)
    {
        $trade = Cryptotrade::where('trx', $id)->orderBy('id','desc')->first();
        $escrow = Cryptoescrow::whereTrade_code($trade->trx)->orderBy('id','desc')->first();
        $wallet = Cryptowallet::whereId($trade->wallet)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }
        
        
         $user = User::whereId($trade->buyer)->first();
        $currency = Currency::whereId($trade->coin)->first();
        if($user){
        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $user->username;
        $subject = 'Transaction Deleted';
        $message = 'Your Transaction Order with transaction number '.$trade->trx.' has been deleted due to expiration of timeout or possible violation of terms ';

        try {
            send_general_email($user->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        } }
       

        
        $trade->delete();
        $chat = Cryptotradechat::whereTradecode($trade->trx)->orderBy('id','desc')->get();
        
        if($chat)
        {
        $chat = Cryptotradechat::whereTradecode($trade->trx)->orderBy('id','desc')->delete();
        }  

       

        $notify[] = ['success', 'You have deleted this trade'];
        return back()->withNotify($notify)->withInput();

    }


         public function canceldispute($id)
    {
        $trade = Cryptotrade::where('trx', $id)->orderBy('id','desc')->first();
        $wallet = Cryptowallet::whereId($trade->wallet)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }

         if($trade->dispute == 0){
         $notify[] = ['error', 'Dispute has already been removed'];
            return back()->withNotify($notify);
        }
        $trade->dispute = 0;
        $trade->save();

        $notify[] = ['success', 'Dispute cancelled successfuly'];
        return back()->withNotify($notify)->withInput();

    }

       public function tradechat($id)
    {
        $trx = $id;
        $data['trade'] = Cryptotrade::where('trx', $trx)->orderBy('id','desc')->first();
        $data['offer'] = Cryptoffer::whereCode($data['trade']->marketcode)->orderBy('id','desc')->first();
        $data['coin'] = Currency::whereId($data['offer']->coin_id)->orderBy('id','desc')->first();
        $data['chat'] = Cryptotradechat::whereTradecode($data['trade']->trx)->orderBy('id','desc')->get();
        if(! $data['offer']){
        $notify[] = ['error', 'Invalid market offer'];
        return back()->withNotify($notify)->withInput();
        }
        $data['now'] = Carbon::now();
        $data['page_title'] = "Chet History";

        return view('admin.offer.chat', $data);
    }

         public function deactivateoffer($id)
    {
        $offer = Cryptoffer::where('code', $id)->orderBy('id','desc')->first();
        if(! $offer){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }

         if($offer->status == 0){
         $notify[] = ['error', 'offer has already been deactivated'];
            return back()->withNotify($notify);
        }
        $offer->status = 0;
        $offer->save();

        $notify[] = ['success', 'Offer deactivated successfuly'];
        return back()->withNotify($notify)->withInput();
    }

         public function activateoffer($id)
    {
        $offer = Cryptoffer::where('code', $id)->orderBy('id','desc')->first();
        if(! $offer){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }

         if($offer->status == 1){
         $notify[] = ['error', 'offer has already been activated'];
            return back()->withNotify($notify);
        }
        $offer->status = 1;
        $offer->save();

        $notify[] = ['success', 'Offer activated successfuly'];
        return back()->withNotify($notify)->withInput();

    }

     public function successfulc()
    {
        $page_title = 'Select Currency';
        $coin = Currency::all();
        return view('admin.offer.successful', compact('page_title','coin'));
    }


     public function successfulofferview($id)
    {

        $data['offer'] = Cryptoffer::whereCoin_id($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find any market offer for this currency'];
        return back()->withNotify($notify)->withInput();
        }

        $data['trx'] = Cryptotrade::where('coin', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('coin', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('coin', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('coin', $id)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('coin', $id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }

        $coin = Currency::whereId($id)->first();
        $data['page_title']  = 'Successful'.$coin->name.' Offers';
        return view('admin.offer.trades', $data);
    }
    
    
    
     public function awaiting()
    {
        $page_title = 'Select Currency';
        $coin = Currency::all();
        return view('admin.offer.awaiting', compact('page_title','coin'));
    }
    
      public function awaitingofferview($id)
    {

        $data['offer'] = Cryptoffer::whereCoin_id($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find any market offer for this currency'];
        return back()->withNotify($notify)->withInput();
        }

        $data['trx'] = Cryptotrade::where('coin', $id)->whereStatus(1)->wherePaid(1)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('coin', $id)->whereStatus(1)->wherePaid(1)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('coin', $id)->whereStatus(1)->wherePaid(1)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('coin', $id)->whereStatus(1)->wherePaid(1)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('coin', $id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }

        $coin = Currency::whereId($id)->first();
        $data['page_title']  = 'Awaiting'.$coin->name.' Offers';
        return view('admin.offer.trades', $data);


    }


    public function pendingc()
    {
        $page_title = 'Select Currency';
        $coin = Currency::all();
        return view('admin.offer.pending', compact('page_title','coin'));
    }



     public function pendingofferview($id)
    {

        $data['offer'] = Cryptoffer::whereCoin_id($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find any market offer for this currency'];
        return back()->withNotify($notify)->withInput();
        }

        $data['trx'] = Cryptotrade::where('coin', $id)->whereStatus(0)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('coin', $id)->whereStatus(0)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('coin', $id)->whereStatus(0)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('coin', $id)->whereStatus(0)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('coin', $id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }

        $coin = Currency::whereId($id)->first();
        $data['page_title']  = 'Pending'.$coin->name.' Offers';
        return view('admin.offer.trades', $data);


    }


     public function declinedc()
    {
        $page_title = 'Select Currency';
        $coin = Currency::all();
        return view('admin.offer.disputed', compact('page_title','coin'));
    }

      public function declinedofferview($id)
    {

        $data['offer'] = Cryptoffer::whereCoin_id($id)->first();
        if(!$data['offer']){
        $notify[] = ['error', 'We cant find any market offer for this currency'];
        return back()->withNotify($notify)->withInput();
        }

        $data['trx'] = Cryptotrade::where('coin', $id)->whereDispute(0)->orderBy('id','desc')->get();
        $data['usd'] = Cryptotrade::where('coin', $id)->whereDispute(0)->orderBy('id','desc')->sum('amount');
        $data['unit'] = Cryptotrade::where('coin', $id)->whereDispute(0)->orderBy('id','desc')->sum('units');
        $data['count'] = Cryptotrade::where('coin', $id)->whereDispute(0)->orderBy('id','desc')->count();
        $data['get'] = Cryptotrade::where('coin', $id)->count();
         if($data['get'] < 1){
        $data['get'] = 1;
        }

        $coin = Currency::whereId($id)->first();
        $data['page_title']  = 'Disputed'.$coin->name.' Offers';
        return view('admin.offer.trades', $data);


    }






}
