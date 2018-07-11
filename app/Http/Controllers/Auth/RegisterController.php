<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm($ref = null)
    {
        return view('auth.register')->with('ref', $ref);
    }

    public function register($ref = null, Request $request)
    {
        if($request->input('ref')) {

            $user = DB::select("SELECT id FROM users WHERE login = ?", [$request->input('ref')]);

            if(!$user) {
            return view('auth.confirm')->with('message', 'Несуществущюий пригласивший');
            }
                       
        }

        $this->validator($request->all())->validate();
        
        $data = [
            'email' => $request->input('email'),
            'login' => $request->input('login'),
            'wallet' => $request->input('wallet'),
            'password' => $request->input('password'),
            'ref' => $request->input('ref')
        ];

        if($request->input('ref') == $request->input('login')) {
            return view('auth.confirm')->with('message', 'Нельзя пригласить самого себя');
        }

        $user = $this->create($data);

        if($user) {
           if($this->sendEmail($user)) {
            return view('auth.confirm')->with('message', 'Вы успешно зарегистрировались. Потвердите свой email');
           }
            
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'login' => 'required|string|min:3|max:15|unique:users',
            'wallet' => 'required|min:3|max:15',
            'password' => 'required|string|min:6|confirmed',
            
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator]);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'wallet' => $data['wallet'],
            'password' => Hash::make($data['password']),
            'ref' => $data['ref']
        ]);
    }

    protected function sendEmail(User $user)
    {
        $token = str_random(30);
        $activationLink = route('activate', ['token' => $token]);

        if(mail($user->email, "Регистрация на сайте", $activationLink)) {
            $user->remember_token = $token;
            $user->save();
            return true;
        }
        return false;
    }

    public function activate($token)
    {
        $user = User::where('remember_token', $token)->first();
        
        if($user->status == 0) {
                    $user->status = 1;
                    $user->remember_token = 'confirmed';
                    $user->save();
                    return view('auth.confirm')->with('message', 'Вы успешно потвердили свой email');
                }
            abort(404);
        }
    }
