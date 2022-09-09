<?php

namespace App\Http\Controllers\Gateway;

use App\GeneralSetting;
use App\Trx;
use App\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GatewayCurrency;
use App\Deposit;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Gateway;
use App\Rules\FileTypeValidate;

class PaymentController extends Controller
{
    public function deposit()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $page_title = 'Deposit Methods';
        return view('user.deposit.deposit', compact('gatewayCurrency', 'page_title'));
    }

    public function depositInsert(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'method_code' => 'required',
            'currency' => 'required',
        ]);



        $user = auth()->user();

        $now = \Carbon\Carbon::now();
        if (session()->has('req_time') && $now->diffInSeconds(\Carbon\Carbon::parse(session('req_time'))) <= 2) {
            $notify[] = ['error', 'Please wait a moment, processing your deposit'];
            return redirect()->route('payment.preview')->withNotify($notify);
        }
        session()->put('req_time', $now);

        $gate = GatewayCurrency::where('method_code', $request->method_code)->where('currency', $request->currency)->first();


        if (!$gate) {
            $notify[] = ['error', 'Invalid Gateway Selected or Gateway Not Found'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please Follow Deposit Limit'];
            return back()->withNotify($notify);
        }

        $charge = formatter_money($gate->fixed_charge + ($request->amount * $gate->percent_charge / 100));

        $payable = formatter_money($request->amount + $charge);

        $final_amo = formatter_money($payable /$gate->rate);



        $depo['user_id'] = $user->id;
        $depo['method_code'] = $gate->method_code;
        $depo['method_currency'] = strtoupper($gate->currency);
        $depo['amount'] = $request->amount;
        $depo['charge'] = $charge;
        $depo['rate'] = $gate->rate;
        $depo['final_amo'] = formatter_money($final_amo);
        $depo['btc_amo'] = 0;
        $depo['btc_wallet'] = "";
        $depo['trx'] = getTrx();
        $depo['try'] = 0;
        $depo['status'] = 0;

        $data = Deposit::create($depo);

        Session::put('Track', $data['trx']);
        $page_title = 'Payment Preview';


        if($data->method_code > 999){
            return redirect()->route('user.manualDeposit.preview');
        }


        return view('payment.preview', compact('data', 'page_title'));
    }


    public function depositConfirm()
    {
        $track = Session::get('Track');
        $deposit = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        if (is_null($deposit)) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        if ($deposit->status != 0) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        if ($deposit->method_code >= 1000) {
            $this->userDataUpdate($deposit);
            $notify[] = ['success', 'Your deposit request is queued for approval.'];
            return back()->withNotify($notify);
        }

        $xx = 'g' . $deposit->method_code;
        $new =  __NAMESPACE__ . '\\' . $xx . '\\ProcessController';

        $data =  $new::process($deposit);
        $data =  json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }


        $page_title = 'Payment Confirm';

        return view($data->view, compact('data', 'page_title','deposit'));
    }


    public static  function userDataUpdate($trx)
    {
        $gnl = GeneralSetting::first();
        $data = Deposit::where('trx', $trx)->first();
        if ($data->status == 0) {
            $data['status'] = 1;
            $data->update();

            $user = User::find($data->user_id);


            $userWallet = UserWallet::where('user_id',$data->user_id)->where('type','deposit_wallet')->first();

            $userWallet->balance += $data->amount;
            $userWallet->save();

            $gateway = $data->gateway;
            Trx::create([
                'user_id' => $data->user_id,
                'amount' => $data->amount,
                'main_amo' => formatter_money($user->balance, config('constants.currency.base')),
                'charge' => formatter_money($data->charge, config('constants.currency.base')),
                'type' => '+',
                'remark' => 'deposit',
                'title' => 'Deposit Via ' . $gateway->name,
                'trx' => $data->trx
            ]);
            $amount = $data->method_currency . ' ' . formatter_money($data->amount, $gateway->crypto());


            if($gnl->deposit_commission == 1){
                $commissionType =  'Commission Rewarded For '. formatter_money($data->amount) . ' '.$gnl->cur_text.' Deposit';
                levelCommision($user->id, $data->amount, $commissionType);
            }

            notify($user, $type = 'DEPOSIT_COMPLETE', [
                'amount' =>  $amount,
                'method' => $gateway->name,
                'trx' => $data->trx,
                'charge' => formatter_money($data->charge),
            ]);

        }
    }

    public function manualDepositPreview()
    {
        $track = Session::get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route('user.deposit');
        }
        $page_title = "Payment Preview";


        return view('user.manual_payment.manual_preview', compact('page_title', 'data'));
    }

    public function manualDepositConfirm()
    {

        $track = Session::get('Track');

        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route('user.deposit');
        }
        if ($data->status != 0) {
            return redirect()->route('user.deposit');
        }

        if($data->method_code > 999){

            $page_title = 'Deposit Confirm';
            $method = $data->gateway_currency();

            return view('user.manual_payment.manual_confirm', compact('data','page_title','method'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = Session::get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route('user.deposit');
        }
        if ($data->status != 0) {
            return redirect()->route('user.deposit');
        }

        $params = json_decode($data->gateway_currency()->parameter);

        $extra = $data->gateway->extra;

        if (!empty($params)) {
            foreach ($params as $param) {
                $validation_rule['ud.' . str_slug($param)] = 'required';
                $validation_msg['ud.'. str_slug($param) .'.required'] =  str_replace("ud."," ",$param) . ' is required';
            }
            $request->validate($validation_rule, $validation_msg);
        }
        if ($request->hasFile('verify_image')) {
            try {
                $filename = upload_image($request->verify_image, config('constants.deposit.verify.path'));
                $data['verify_image'] = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your '.$extra->verify_image];
                return back()->withNotify($notify)->withInput();
            }
        }

        $data->detail =$request->ud;
        $data->status = 2; // pending
        $data->update();

        notify($data->user, $type = 'DEPOSIT_PENDING', [
            'trx' => $data->trx,
            'amount' => formatter_money($data->amount) . ' '.$data->method_currency,
            'method' => $data->gateway_currency()->name,
            'charge' => formatter_money($data->charge) . ' '.$data->method_currency,
        ]);

        $notify[] = ['success', 'You have deposit request has been taken.'];
        return redirect()->route('user.deposit')->withNotify($notify);
    }
}
