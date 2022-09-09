<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\UserWallet;
use Carbon\Carbon;
use App\Invest;
use App\Trx;
use App\User;
use Illuminate\Support\Facades\Request;

class CronController extends Controller
{

    public function cron()
    {
        $now = Carbon::now();


            $invest = Invest::whereStatus(1)->where('next_time','<=',$now)->get();


        $gnl = GeneralSetting::first();

        foreach ($invest as $data)
        {
            $user = User::find($data->user_id);
            $userInterestWallet = UserWallet::where('user_id',$data->user_id)->where('type','interest_wallet')->first();
            $next_time = Carbon::parse($now)->addHours($data->hours);

            $in = Invest::find($data->id);
            $in->return_rec_time = $data->return_rec_time + 1;
            $in->next_time = $next_time;
            $in->last_time = $now;

            if ($data->period == '-1')
            {
                $in->status = 1;
                $in->save();

                $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                $userInterestWallet->balance = $new_balance;

                Trx::create([
                    'user_id' => $user->id,
                    'amount' => $data->interest,
                    'main_amo' => $new_balance,
                    'charge' => 0,
                    'type' => '+',
                    'remark' => 'interest',
                    'title' => 'Interest Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                    'trx' => getTrx(),
                ]);
                $userInterestWallet->save();

                if($gnl->invest_return_commission == 1){
                    $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                    levelCommision($user->id, $data->interest, $commissionType);
                }


            }else{

                if ($data->capital_status == 1)
                {

                    if ($in->return_rec_time >= $data->period){
                        $bonus = $data->interest + $data->amount;
                        $new_balance = formatter_money($userInterestWallet->balance + $bonus);
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 0;
                    }else{
                        $bonus = 0;
                        $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 1;
                    }

                    $in->save();



                    if ($bonus != 0){

                        Trx::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                            'trx' => getTrx(),
                        ]);

                        if($gnl->invest_return_commission == 1){
                            $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                            levelCommision($user->id, $data->interest, $commissionType);
                        }

                    }else{
                        Trx::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest & Capital Return '.$bonus.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                            'trx' => getTrx(),
                        ]);

                        if($gnl->invest_return_commission == 1){
                            $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                            levelCommision($user->id, $data->interest, $commissionType);
                        }

                    }


                    $userInterestWallet->save();



                }else{

                    if ($in->return_rec_time >= $data->period){
                        $in->status = 0;
                    }else{
                        $in->status = 1;
                    }

                    $in->save();

                    $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                    $userInterestWallet->balance = $new_balance;
                    $userInterestWallet->save();
                    Trx::create([
                        'user_id' => $user->id,
                        'amount' => $data->interest,
                        'main_amo' => $new_balance,
                        'charge' => 0,
                        'type' => '+',
                        'remark' => 'interest',
                        'title' => 'Interest Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                        'trx' => getTrx(),
                    ]);


                    if($gnl->invest_return_commission == 1){
                        $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                        levelCommision($user->id, $data->interest, $commissionType);
                    }

                }

            }

        }


    return 'Cron Job Successful';
    }




}
