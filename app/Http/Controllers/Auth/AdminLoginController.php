<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
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
        $this->middleware('guest');
    }

    public function id()
    {
        return 'id';
    }

    protected function showAdminLoginForm(Request $request)
    {
        return view('admin-login');
    }

    protected function adminLogin(Request $request)
    {
        // $password = $request->input('password');
        // $admin = Admin::find(1);

        // if (Hash::check($password, $admin->password)) {
        //     return redirect('/admin/home');
        // }

        //Attempt to log the user in
        if(Auth::guard('admin')->attempt(['id'=> $request->id, 'password'=> $request->password], false)) {
            //If successful, then redirect to their intended location
            return redirect('/admin/home');
        }
        //If unsuccesstul, then redirect back to the login with the form data
        return redirect()->back();
    }

    protected function loggedOut(Request $request) {
        return redirect()->route('/logout');
    }
}
