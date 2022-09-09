<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Trx;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transaction()
    {
        $page_title = 'Transaction Logs';
        $transactions = Trx::with('user')->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function transactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Transactions Search - ' . $search;
        $empty_message = 'No transactions.';
        $transactions = Trx::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('username', $search);
        })->orWhere('trx', $search)->paginate(config('constants.table.default'));
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }
}
