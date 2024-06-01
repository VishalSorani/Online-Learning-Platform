<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticated(){
        if(Auth::user()->user_type == '1'){
            return redirect('/admin/dashboard')->with('status','Welcome to Dashboard');
        }else if((Auth::user()->user_type == '0')){
            return redirect('/home')->with('status','Login Successful');
        }else{
            return redirect('/home');
        }
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
