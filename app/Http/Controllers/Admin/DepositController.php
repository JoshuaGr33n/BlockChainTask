<?php

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\GeneralSetting;
use App\Trx;
use App\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    public function deposit()
    {
        $page_title = 'Deposit History';
        $empty_message = 'No deposit history available.';
        $deposits = Deposit::with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        if (empty($search)) return back();
        $page_title = '';
        $empty_message = 'No search result was found.';

        $deposits = Deposit::with(['user', 'gateway'])->where(function ($q) use ($search) {
            $q->where('trx', $search)->orWhereHas('user', function ($user) use ($search) {
                $user->where('username', $search);
            });
        });
        switch ($scope) {
            case 'pending':
                $page_title .= 'Pending Deposits Search';
                $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 2);
                break;
            case 'approved':
                $page_title .= 'Approved Deposits Search';
                $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 1);
                break;
            case 'rejected':
                $page_title .= 'Rejected Deposits Search';
                $deposits = $deposits->where('method_code', '>=', 1000)->where('status', -2);
                break;
            case 'list':
                $page_title .= 'Deposits History Search';
                break;
        }
        $deposits = $deposits->paginate(config('constants.table.defult'));
        $page_title .= ' - ' . $search;

        return view('admin.deposit_list', compact('page_title', 'search', 'scope', 'empty_message', 'deposits'));
    }

    public function pending()
    {
        $page_title = 'Pending Deposits';
        $empty_message = 'No pending deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', 2)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits'));
    }

    public function approved()
    {
        $page_title = 'Approved Deposits';
        $empty_message = 'No approved deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', 1)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits'));
    }

    public function rejected()
    {
        $page_title = 'Rejected Deposits';
        $empty_message = 'No rejected deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', -2)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits'));
    }

    public function approve(Request $request)
    {
        $gnl = GeneralSetting::first();
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();
        $deposit->update(['status' => 1]);


        $user = UserWallet::where('user_id', $deposit->user_id)->where('type', 'deposit_wallet')->first();
        $user['balance'] = formatter_money(($user['balance'] + $deposit->amount));
        $user->update();


        Trx::create([
            'user_id' => $deposit->user_id,
            'amount' => formatter_money($deposit->amount),
            'main_amo' => $user->balance,
            'charge' => $deposit->charge,
            'type' => '+',
            'remark' => 'deposit',
            'title' => 'Deposit Via ' . $deposit->gateway_currency()->name,
            'trx' => $deposit->trx
        ]);


        if($gnl->deposit_commission == 1){
            $commissionType =  'Commission Rewarded For '. formatter_money($deposit->amount) . ' '.$gnl->cur_text.' Deposit';
            levelCommision($user->id, $deposit->amount, $commissionType);
        }


        notify($user->user, $type = 'DEPOSIT_APPROVE', [
            'amount' => formatter_money($deposit->amount),
            'gateway_currency' => $deposit->method_currency,
            'gateway_name' =>  $deposit->gateway_currency()->name,
            'transaction' =>  $deposit->trx,
        ]);


        $notify[] = ['success', 'Deposit has been approved.'];
        return back()->withNotify($notify);
    }

    public function reject(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();
        $deposit->update(['status' => -2]);

        notify($deposit->user, $type = 'DEPOSIT_REJECT', [
            'amount' => formatter_money($deposit->amount),
            'gateway_currency' => $deposit->method_currency,
            'gateway_name' =>  $deposit->gateway_currency()->name,
        ]);



        $notify[] = ['success', 'Deposit has been rejected.'];
        return back()->withNotify($notify);
    }
}
