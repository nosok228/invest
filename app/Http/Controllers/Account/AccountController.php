<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\PasswordReset;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Payment;
use App\Request as Requests;

class AccountController extends Controller
{
    public function index()
    {
        if($this->checkStatus()) {
            $wallet = DB::select("SELECT SUM(sumout) FROM payments WHERE user_id = ? AND investFinish < NOW()", [Auth::user()->id]);

            return view('account.profile')->with('wallet', (float)$this->objectToarray($wallet[0]));
        }
        else {
            return view('account.profile')->with('notice', 'Ваш аккаунт не потвержден. Потвердите его чтобы использывать все доступные функции');
        }
    }

    public function showChangeForm()
    {
        $wallet = Payment::where('user_id', Auth::user()->id);

        return view('account.change')->with('wallet', $wallet);
    }

    public function change(ChangePasswordRequest $request)
    {
        $password = Auth::user()->password;
        
        if(Hash::check($request->input('old_password'), $password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect()->route('profile')->with('success', 'Пароль успешно изменен');
        }
        return view('account.change')->with('error', 'Неверный пароль');
    }

    public function showForgetForm()
    {
        return view('account.forget');
    }

    public function forget(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        
        if($user) {
            $token = str_random(40);
            $passwordReset = new PasswordReset();

            $user->password = $token;
            $user->save();

            $passwordReset->email = $user->email;
            $passwordReset->token = $token;
            $passwordReset->save();

            $activateLink = route('recovery', ['token' => $token]);
            mail($user->email, 'Восстановления пароля', 'Перейдите по сылке '.$activateLink);

            return view('account.forget')->with('success', 'Запрос на востановления пароля отправлен вам на email');
            }
        else {
            return view('account.forget')->with('error', 'Не найдет такой email');
        }
    }

    public function showRecoveryForm($token)
    {
        $user = User::where('password', $token)->first();
        if($user) {
        return view('account.recovery');
      }
        else {
            return view('layouts.message')->with('error', 'Вы уже поменяли пароль');
        }
    }

    public function recovery($token, Request $request)
    {
        $user = User::where('password', $token)->first();

            $user->password = $request->input('password');

            if($request->input('password') == $request->input('password_confirmation')) {
                $user->password = Hash::make($request->input('password'));
                $user->save();

                mail($user->email, 'Смена пароля', 'Вы успешно сменили пароль');

                return view('layouts.message')->with('success', 'Вы успешно поменяли пароль');
            }
            else {
                return view('account.recovery')->with('error', 'Пароли не совпадают');
            }
        }

    public function showChangeWalletForm()
    {
        return view('account.changeWallet');
    }

    public function changeWallet(Request $request)
    {
        $password = Auth::user()->password;
        
        if(Hash::check($request->input('password'), $password)) {
            if($request->input('wallet') < 4) {
                return view('account.changeWallet')->with('error', 'Не верно указан кошелек');
            }

            $user = User::find(Auth::user()->id);
            $user->wallet = $request->input('wallet');
            $user->save();

            return view('layouts.message')->with('success', 'Вы успешно поменяли кошелек');
        }

        else {
            return view('layouts.message')->with('error', 'Пароль не верный');
        }
    }

    public function takeMoney(Request $request)
    {
        $sum = $request->input('sum');

        if($sum) {
            $requestTry = Requests::find(Auth::user()->id);
            if(!$requestTry) {
                $request = new Requests();
                $request->user_id = Auth::user()->id;
                $request->login = Auth::user()->login;
                $request->email = Auth::user()->email;
                $request->sum = $sum;
                $request->wallet = Auth::user()->wallet;
                $result = $request->save();

                if($result) {
                    return view('layouts.message')->with('succes', 'Заявка на вывод средств отправлена');
                }
                return view('layouts.message')->with('error', 'Произошла ошибка. Попробуйте отправить запрос поздже');
            }
           else {
            return view('layouts.message')->with('error', 'Вы уже запросили вывод средств');
           }
           if($requestTry->status == 0) {
            return view('layouts.message')->with('error', 'Вы уже запросили вывод средств');
           }
        }
    }


    protected function checkStatus()
    {
        if(Auth::user()->status == 1 and !is_null(Auth::user()->remember_token)) {
            return true;
        }

        return false;
    }

    protected function objectToArray($oStdClass) 
    {
        if (is_object($oStdClass)) {
            $oStdClass = get_object_vars($oStdClass);
        }
    
        if (is_array($oStdClass)) {
            return array_map('self::' . __FUNCTION__, $oStdClass);
        }
        else {
            return $oStdClass;
        }
    }

}
