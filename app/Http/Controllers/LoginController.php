<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{


    
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return Inertia::location('users');
        /* return redirect()->intended(RouteServiceProvider::HOME); */
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
    


    /*  public function login(LoginRequest $request)
    {
        return $this->authenticated($request);
    } */

    /*protected function credentials(Request $request)
    {        
        return [
            'email' => $request->username,
            'password' => $request->password
        ];
    }

    public function authenticated(Request $request)
    {
        $credentials = $this->credentials($request);

        if (Auth::attempt($credentials)) {

            if(Auth::user()->active == 2) {
                Auth::logout();
                return redirect('login')->withErrors(trans('auth.inactive'));
            }

            Session::put('useremail', Auth::user()->email);
            return Inertia::location('home');


        }else{
            return redirect()->to('login')->withErrors(trans('auth.failed'));
        }
    }

   
    public function logout(){
        Auth::logout();
        return redirect('login');
    } */
}