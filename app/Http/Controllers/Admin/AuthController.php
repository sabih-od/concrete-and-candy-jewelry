<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.pages.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return WebResponses::successRedirect('admin.dashboard', ' Successfully Logged in ');
        } else {

            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return WebResponses::successRedirect('admin.login.form', 'Successfully logout');

    }
}
