<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');

        //$remember = empty($request->only('remember_token'))? false : true;

        if (Auth::attempt($credentials)) {

            if (is_null(Auth::user()->email_verified_at))
            {
                Auth::logout();
                
                $request->session()->flash('login', ['icon' => 'error', 'title' => 'Email is not verified', 'msg' => 'Verify your email!']);

                return redirect('login');
            }


            return redirect()->route('dashboard')->with('Welcome! Your dashboard is ready for you!');;
        }

        $request->session()->flash('login', ['icon' => 'error', 'title' => 'Oops...', 'msg' => 'Invalid email or password!']);

        return redirect('login');
    }


    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        return view('auth.login');
    }


    /**
     * logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flash('login', ['icon' => 'success', 'title' => 'Success', 'msg' => "You've been logged out"]);

        return redirect('login');
    }
}
