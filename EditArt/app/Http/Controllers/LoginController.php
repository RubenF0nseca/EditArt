<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Store\CartController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;

class LoginController extends Controller
{
    /**
     * Mostra o formulário de login
     */
    public function showLogin(Request $request)
    {
        return view('login.show', [
            'redirect' => $request->input('redirect'),
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

        // Verificar quantas tentativas já foram feitas
        $key = 'login_attempts:' . $request->input('email');
        $attempts = Cache::get($key, 0);

        // Se errar 5 vezes, verifica se ainda está bloqueado
        if ($attempts >= 5) {
            $lockoutTime = Cache::get('lockout_time:' . $request->input('email'));

            if ($lockoutTime && now()->diffInMinutes($lockoutTime) < 5) {
                return back()->withErrors(['error' => "Muitas tentativas. Tente novamente após 5 minutos ou vá ao seu email para redefinir a password"]);
            }

            // Se já passou o tempo de bloqueio, faz reset das tentativas
            Cache::forget($key);
            Cache::forget('lockout_time:' . $request->input('email'));
        }

        // Tenta autenticar o utilizador
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            app(CartController::class)->mergeCart();

            // Limpa as tentativas ao fazer login com sucesso
            Cache::forget($key);
            Cache::forget('lockout_time:' . $request->input('email'));

            $redirectUrl = $this->getValidRedirectUrl($request);
            if ($redirectUrl) {
                return redirect()->to($redirectUrl)->with("success", "Login efetuado com sucesso!.");
            }

            $defaultRedirect = auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('home');
            return redirect()->intended($defaultRedirect)->with("success", "Login efetuado com sucesso!");
        }

        // Se o login falhar, incrementa o contador de tentativas
        $attempts++;
        Cache::put($key, $attempts, now()->addMinutes(5));

        // Se atingir 5 tentativas falhadas, bloqueia e envia email
        if ($attempts == 5) {
            // Marca o tempo de bloqueio
            Cache::put('lockout_time:' . $request->input('email'), now(), now()->addMinutes(5));

            // Envia email com link para redefinir senha
            $user = User::where('email', $request->input('email'))->first();
            if ($user) {
                $token = app('auth.password.broker')->createToken($user);
                $user->notify(new ResetPasswordNotification($token));
            }
        }

        return back()->withInput($request->only('email', 'redirect'))
            ->withErrors(['error' => 'Verifique as suas credenciais!']);
    }
    /**
     * Termina a sessão do utilizador
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

    /**
     * Verifica se o URL é válido para redirecionamento
     */
    private function isValidRedirect($url)
    {
        if (!str_starts_with($url, '/')) {
            return false;
        }

        return !preg_match('/\/\/+/', $url); // Evita URLs malformadas
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
