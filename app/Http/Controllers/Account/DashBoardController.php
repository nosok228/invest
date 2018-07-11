<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tarif;
use App\User;
use App\Payment;
use TheSeer\Tokenizer\Exception;

class DashBoardController extends Controller
{
    public function showBuyForm(int $id)
    {
        $tariff = Tarif::find($id);
        $userId = Auth::user()->id;    
        
        return view('dashboard.invest')->with(['tariff'=> $tariff, 'userId' => $userId]);
    }

    public function history()
    {
        $list = [];

        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();

        if(isset($payments)) {
            $list['payments'] = $payments;
        }

        return view('account.history')->with('list', $list);
    }

    public function referals()
    {
    $referals = User::where('ref', Auth::user()->login)->get();
    $user = User::find(Auth::user()->id);

    return view('account.referals')->with(['referals'=> $referals, 'user' => $user]);
    }

}
