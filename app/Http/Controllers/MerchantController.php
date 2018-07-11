<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif;
use App\Payment;
use App\User;
use App\ReferalPayment;

class MerchantController extends Controller
{
    public function perfectMoney()
    {
        $_POST['PAYMENT_AMOUNT'] = 3000;
		$_POST['PAYEE_ACCOUNT'] = '';
		$_POST['PAYMENT_BATCH_NUM'] = '';
		$_POST['PAYER_ACCOUNT'] = '';
		$_POST['TIMESTAMPGMT'] = '';
		$_POST['PAYMENT_UNITS'] = 'USD';
        $_POST['PAYMENT_ID'] = '3,1';
        
        $data = $this->validatePerfectMoney($_POST);

        if(!$data) {
            abort(403);
        }

        $result = $this->fillTarif($data);
        // dd($result);
        if($result) {
            return view('layouts.message')->with('success', 'Платеж прошел успешно. Спасибо');
        }
        else {
            return view('layouts.message')->with('error', 'Что то пошло не так');
        }
    }

    protected function validatePerfectMoney($post)
    {
            $params = 
                $post['PAYMENT_ID'].':'.
                $post['PAYEE_ACCOUNT'].':'.
                $post['PAYMENT_AMOUNT'].':'.
                $post['PAYMENT_UNITS'].':'.
                $post['PAYMENT_BATCH_NUM'].':'.
                $post['PAYER_ACCOUNT'].':'.
                strtoupper(md5('1k96rIr1fPkAaQa8AHHDbEumW')).':'.
                $post['TIMESTAMPGMT'];
            
            list($tid, $uid) = explode(',', $post['PAYMENT_ID']);
            (int) $tid;
            (int) $uid;
            $tariff = Tarif::find($tid);
            $amount = $post['PAYMENT_AMOUNT'];
            (int) $amount; 
            // if (strtoupper(md5($params)) != $post['V2_HASH']) {
            //     return false;
            // }
            if ($post['PAYMENT_UNITS'] != 'USD') {
                return false;
            }
            // elseif (!empty($tariff->id)) {
            //     return false;
            // }
            elseif ($amount < $tariff->min or $amount > $tariff->max) {
                return false;
            }
            return [
                'tid' => $tid,
                'uid' => $uid,
                'amount' => $amount,
            ];
        }

        protected function fillTarif($data)
        {
            $user = User::find($data['uid']);
            if($user) {
            //   if($user->status == true) {
              $tarif = Tarif::find($data['tid']);

            if($user->ref) {
                $refBonus = round(($data['amount'] * 2) / 100, 2);
                $referal = User::where('login', $user->ref)->first();
                $refBalance = $referal->refBalance;
                $referal->refBalance = $refBalance + $refBonus;
                $referal->save();

                $referer = new ReferalPayment();
                $referer->create([
                    'referal_id' => $data['uid'],
                    'referer_id' => $referal->id,
                    'percentToReferer' => $refBonus
                ]);
            }

            $date = date_create(date("d.m.Y H:i:s"));
            date_add($date, date_interval_create_from_date_string($tarif->hour.' days'));
            $investFinish = date_format($date, 'Y-m-d H:i:s');

            $insert = Payment::create([
            'user_id' => $data['uid'],
			'sumin' => round($data['amount'], 2),
			'sumout' => round($data['amount'] + (($data['amount'] * $tarif->percent) / 100), 2),
			'percent' => $tarif->percent,
			'investStart' => date('Y-m-d H:i:s'),
			'investFinish' => $investFinish
            ]);
            
            return $insert;
        }
        return false;
    // }
    //     return false;
    }
}

