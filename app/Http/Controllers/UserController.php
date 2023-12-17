<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticateUsers;
use App\Models\User;
use Auth;
use Hash;
use Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username','password');

        if(Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
