<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthWebController extends Controller{

    public function showLogin(){
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'phone' => ['required', 'string', 'max:15'],
            'password' => ['required'],
        ], [
            'phone.required' => 'Telefon raqam kiritilishi shart',
            'password.required' => 'Parol kiritilishi shart',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'phone' => 'Berilgan ma’lumotlar bazamizda topilmadi.',
        ])->onlyInput('phone');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}