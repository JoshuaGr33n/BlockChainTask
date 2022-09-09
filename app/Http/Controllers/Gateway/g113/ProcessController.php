<?php

namespace App\Http\Controllers\Gateway\g113;

use App\Deposit;
use App\GeneralSetting;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use Illuminate\Support\Facades\Session;
require_once('lib/Twocheckout.php');

class ProcessController extends Controller
{

    /*
     * 2checkout Gateway
     */
    public static function process($deposit){
        $twoCheck = json_decode($deposit->gateway_currency()->parameter);

        $send['track'] = $deposit->trx;
        $send['view'] = 'payment.g113';

        $send['method'] = 'post';
        $send['url'] = route('ipn.g113');


        $send['sellerID'] = $twoCheck->seller_id;
        $send['private_key'] = $twoCheck->private_key;
        $send['public_key'] = $twoCheck->public_key;

        return json_encode($send);
    }

    public function ipn(Request $request){
        
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        if($data->status == 1){
            $notify[] = ['error', 'Invalid Request.'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        $twoCheck = json_decode($data->gateway_currency()->parameter);
        \Twocheckout::privateKey($twoCheck->private_key);
        \Twocheckout::sellerId($twoCheck->seller_id);
        \Twocheckout::sandbox(true);

        try {
            $name = $data->user->username;
            $prefillEmail = $data->user->email;
            $prefillContact = $data->user->mobile;

            $charge = \Twocheckout_Charge::auth(array(
                "merchantOrderId" => $data->trx,
                "token"      => $request->token,
                "currency"   =>$data->method_currency,
                "total"      => $data->final_amo,
                "billingAddr" => array(
                    "name" => $name,
                    "addrLine1" => '123 Test St',
                    "city" => 'Columbus',
                    "state" => 'OH',
                    "zipCode" => '43123',
                    "country" => 'USA',
                    "email" => $prefillEmail,
                    "phoneNumber" => $prefillContact
                )
            ));

            if ($charge['response']['responseCode'] == 'APPROVED') {
                PaymentController::userDataUpdate($data);
                $notify[] = ['success', 'Payment Success.'];
            }
        } catch (\Twocheckout_Error $e) {
            $notify[] = ['error', $e->getMessage()];
        }

        return redirect()->route('user.deposit')->withNotify($notify);
    }



}
