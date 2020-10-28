<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmailVerifyController extends Controller
{
    /**
     * verificationNotice
     *
     * @return void
     */
    public function verificationNotice()
    {
        return view('auth.verify-email');
    }


    /**
     * verificationBeforeSend
     *
     * @return void
     */
    public function verificationBeforeSend()
    {
        return view('auth.verify');
    }


    /**
     * verificationVerify
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function verificationVerify(Request $request, $id)
    {
        Auth::loginUsingId($id);

        $user = User::find($id);
        $user->email_verified_at = now();
        $user->save();

        $request->session()->flash('dashboard', ['icon' => 'success', 'title' => 'Success', 'msg' => "Your email has been verified!"]);

        return redirect('dashboard');
    }
}
