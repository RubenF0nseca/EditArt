<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(){
        return view('login.show');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Por favor, introduza o seu email.',
            'email.email' => 'Introduza um email válido.',
            'password.required' => 'A palavra-passe é obrigatória.',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            if (auth()->user()->hasRole('admin'))
                return redirect()->route('admin.dashboard');
            else
                return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'error' => 'Verifique as suas credênciais!'
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}
