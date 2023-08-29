<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){


            $request ->validate([
             // name属性↓
                'username' =>'required|min:2|max:12',
                'mail' =>'required|min:5|max:40|unique:users,mail|email',
                'password' =>'required|regex:/\A([a-zA-Z0-9]{8,})+\z/u|max:20|confirmed:password',
                'password_confirmation' =>'required|regex:/\A([a-zA-Z0-9]{8,})+\z/u|max:20',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

        // getは、sessionの中にある値を取り出す。取得するってこと
        $value = $request->session()->get('username');

        // sessionの中に（'キー名'、値）を保存する、送る
        $request->session()->put('username', $username);


            return redirect('added');

        }
        return view('auth.register');
    }

    public function added(Request $request){


        // $value = $request->session()->get('key');
        // $values = $request->session()->all();
        // $request->session()->put('key', 'value');


        return view('auth.added');
    }
}
