<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Tarif;
use App\Payment;
use App\Request as Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();

        return view('admin.tarifs')->with('tarifs', $tarifs);
    }

    public function showAddForm()
    {
        return view('admin.add_tarif');
    }

    public function add(Request $request)
    {
        $tarif = new Tarif();
        $tarif->title = $request->input('title');
        $tarif->description = $request->input('description');
        $tarif->hour = $request->input('hour');
        $tarif->percent = $request->input('percent');
        $tarif->min = $request->input('min');
        $tarif->max = $request->input('max');
        
        if($tarif->save()) {
            return view('layouts.message')->with('success', 'Тариф успешно добавлен');
        }
        else {
            return view('layouts.message')->with('error', 'Ошибка при добавлении тарифа');
        }
    }

    public function showEditForm(int $id)
    {
        $tarif = Tarif::find($id);

        if(!$tarif) {
            abort(404);
        }

        return view('admin.edit_tarif')->with('tarif', $tarif);
    }

    public function edit(Request $request, int $id)
    {
        $tarif = Tarif::find($id);
        $tarif->title = $request->input('title');
        $tarif->description = $request->input('description');
        $tarif->hour = $request->input('hour');
        $tarif->percent = $request->input('percent');
        $tarif->min = $request->input('min');
        $tarif->max = $request->input('max');
        
        if($tarif->save()) {
            return view('layouts.message')->with('success', 'Тариф успешно изменен');
        }
        else {
            return view('layouts.message')->with('error', 'Ошибка при изменении тарифа');
        }
    }
    public function delete(int $id)
    {
        Tarif::where('id', $id)->delete();

        return view('layouts.message')->with('success', 'Тариф успешно удален');
    }

    public function showWithdrawForm()
    {
        $requests = Requests::where('status', 1)->get();

        return view('admin.withdraw')->with('requests', $requests);
    }

    public function withdraw(Request $request)
    {
        if($request->input('type') == 'tariff') {
            $payments = Payment::where('user_id', $request->input('id'))
            ->where('investFinish', '<', date('Y-m-d H:i:s'))
            ->get();

            if(!$payments) {
                return view('layouts.message')->with('error', 'Что то пошло не так');
            }

            DB::update("UPDATE payments SET sumout = 0 WHERE user_id = ? AND investFinish < NOW()", [$request->input('id')]);

            $req = Requests::where('user_id', $request->input('id'))->first();
            $req->status = 1;
            $req->save();

            return view('layouts.message')->with('succes', 'Деньги успешно выплачены');
        }
        else {
            return view('layouts.message')->with('error', 'Что то пошло не так');
        }
    }

    public function history()
    {
        $history = Payment::all();
        $arr = [];

        foreach($history as $key => $value) {
            $arr[$key] = User::find($value->user_id);
        }

        return view('admin.history')->with(['history' => $history, 'users' => $arr]);
    }
}
