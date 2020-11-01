<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

/**
 * ProfileController
 */
class ProfileController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('user.profile');
    }


    /**
     * updateProfile
     *
     * @param  mixed $request
     * @return void
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name =  $request->name;
        $user->email = $request->email;
        $user->save();

        Auth::user()->email = $user->email;
        Auth::user()->name = $user->name;

        return [
            "message" => "You update your profile",
            "errors" => 'false'
        ];

    }

    /**
     * changePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        if(!Hash::check($request->password, Auth::user()->password))
        {
            return [
                "message" => "Old password not match",
                "errors" => 'true'
            ];
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->newPassword);
        $user->save();

        Auth::user()->password = $user->password;
        Auth::user()->name = $request->name;

        return [
            "message" => "You update your password",
            "errors" => 'false'
        ];
    }
}
