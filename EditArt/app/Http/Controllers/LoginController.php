<?php

namespace App\Http\Controllers;

use App\Notifications\UserLoggedInNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    /**
     * Mostra o formulário de login
     */
    public function showLogin(Request $request)
    {
        return view('login.show', [
            'redirect' => $request->input('redirect')
        ]);
    }

    /**
     * Processa o login
     */
    public function login(Request $request)
    {
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

            // Priorizar redirecionamento personalizado
            $redirectUrl = $this->getValidRedirectUrl($request);

            if ($redirectUrl) {
                return redirect()->to($redirectUrl)
                    ->with("success", "Login efetuado com sucesso!.");
            }

            $defaultRedirect = auth()->user()->hasRole('admin')
                ? route('admin.dashboard')
                : route('home');

            return redirect()->intended($defaultRedirect)
                ->with("success", "Login efetuado com sucesso!.");
        }

        return redirect()->back()
            ->withInput($request->only('email', 'redirect'))
            ->withErrors(['error' => 'Verifique as suas credênciais!']);
    }


    /**
     * Termina a sessão do utilizador
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }

    /**
     * Verifica se o url é valido para redirecionamento
     */
    private function isValidRedirect($url)
    {
        if (!str_starts_with($url, '/')) {
            return false;
        }

        return !preg_match('/\/\/+/', $url); // Evitar URLs malformadas
    }

    /**
     * Retorna o URL de redirecionamento válido
     */
    private function getValidRedirectUrl(Request $request)
    {
        $redirectUrl = $request->input('redirect');
        Log::info("Redirect URL: {$redirectUrl}");
        Log::info("Validation: " . ($this->isValidRedirect($redirectUrl) ? 'Valid' : 'Invalid'));

        if ($redirectUrl && $this->isValidRedirect($redirectUrl)) {
            return $redirectUrl;
        }

        return null;
    }


}
