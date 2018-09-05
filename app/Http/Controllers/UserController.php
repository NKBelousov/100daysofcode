<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('profile');
    }
}
