<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();

        return view('index')->with(['tarifs' => $tarifs]);
        
    }
}
