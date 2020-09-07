<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        //$user = Auth::user(); // retrieves the authenticated user
        //$tasks = Auth::user()->tasks; // oh yes! it's an Eloquent object!
        //$id = Auth::id(); // retrieves the currently authenticated user's ID
        return view('auth.login', [
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Log In',
            'editable'=>false,
            'user' => false
        ]);
    }
}
