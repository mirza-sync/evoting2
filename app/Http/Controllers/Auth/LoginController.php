<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $result = $this->guard()->attempt(
            $this->credentials($request), 
            $request->filled('remember')
        );

        if ($result) {
            
            auth()->user()->sendOTP(request('via'));
        }
        return $result;
    }

    // protected function loggedOut(Request $request) {
    //     return redirect('/login');
    // }
    public function logout(Request $request)
    {
        if(Auth::guard('web')->check()){
            auth()->user()->update(['isVerified' => 0]);
            Auth::guard('web')->logout();
        }
        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        return redirect('/');

        // Auth::guard('admin')->logout();
        // return redirect()->intended('/');
    }
}
