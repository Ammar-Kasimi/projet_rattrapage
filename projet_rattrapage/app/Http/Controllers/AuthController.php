<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $req)
    {
        $creds = $req->validated();

        if ($req->hasFile('pic')) {
            $creds['pic'] = $req->file('pic')->store('users', 'public');
        } else {
            unset($creds['pic']);
        }

        $user = User::create($creds);
        Auth::login($user);
        return $user->role == 'admin' ?
            redirect()->route('admin.dashboard')
            : redirect()->route('events.index');
    }
    public function login(LoginRequest $req)
    {
        $creds = $req->validated();
        if (Auth::attempt($creds)) {
            $req->session()->regenerate();
            return Auth::user()->role == 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('events.index');
        }
        return back()->withErrors(["creds wrong" => "the email or password is wrong please try again"])->withInput();
    }
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('events.index');
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function showLogin()
    {
        return view('auth.login');
    }
}
