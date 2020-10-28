<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
