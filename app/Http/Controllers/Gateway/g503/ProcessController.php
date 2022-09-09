<?php

namespace App\Http\Controllers\Gateway\g503;

use App\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*
     * CoinPaymentHosted Gateway
     */

    public static function process($deposit)
    {

        $coinPayAcc = json_decode($deposit->gateway_currency()->parameter);

        if ($deposit->btc_amo == 0 || $deposit->btc_wallet == "") {
            $cps = new CoinPaymentHosted();
            $cps->Setup($coinPayAcc->private_key, $coinPayAcc->public_key);
            $callbackUrl = route('ipn.g503');

            $req = array(
                'amount' => $deposit->final_amo,
                'currency1' => 'USD',
                'currency2' => $deposit->method_currency,
                'custom' => $deposit->trx,
                'ipn_url' => $callbackUrl,
            );

            $result = $cps->CreateTransaction($req);
            if ($result['error'] == 'ok') {
                $bcoin = sprintf('%.08f', $result['result']['amount']);
                $sendadd = $result['result']['address'];
                $deposit['btc_amo'] = $bcoin;
                $deposit['btc_wallet'] = $sendadd;
                $deposit->update();
            } else {
                $send['error'] = true;
                $send['message'] = $result['error'];
            }
        }

        $send['amount'] = $deposit->btc_amo;
        $send['sendto'] = $deposit->btc_wallet;
        $send['img'] = cryptoQR($deposit->btc_wallet, $deposit->btc_amo);
        $send['currency'] = "$deposit->method_currency";
        $send['view'] = 'payment.crypto';
        return json_encode($send);
    }

    public function ipn(Request $request)
    {

        $track = $request->custom;
        $status = $request->status;
        $amount2 = floatval($request->amount2);
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        if ($status >= 100 || $status == 2) {
            $coinPayAcc = json_decode($data->gateway_currency()->parameter);

            if ($data->method_currency == $request->currency2 && $data->btc_amo <= $amount2  && $coinPayAcc->merchant_id == $request->merchant && $data->status == '0') {
                PaymentController::userDataUpdate($data->trx);
            }
        }
    }
}
