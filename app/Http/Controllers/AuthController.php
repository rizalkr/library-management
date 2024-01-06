<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Login
    public function login()
    {
        return view('auth.login');
    }

    // register
    public function register()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Cek user status active = true
            if (Auth::user()->status != 'active') {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet, please contact admin!');
                return redirect('/login');
            }
            // If login is successful, redirect to intended page
            if (Auth::user()->role_id != 1) {
                return redirect('profile');
            }

            return redirect('dashboard');

        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login invalid');
        return redirect('/login')->withInput($request->only('username'));
    }

    public function registerProccess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone' => 'max:255',
            'address' => 'required|max:255',
        ]);

        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Register success, wait for admin aproval');
        return redirect('register');
    }
}
