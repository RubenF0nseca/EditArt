<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Exibe a view de "Esqueceu a password" (para o utilizador colocar o email).
     */
    public function showForgotForm()
    {
        return view('client.ForgotPassword');
    }

    /**
     * Processa o envio do link de reset de password.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with("success", "Email enviado com sucesso!")
            : back()->withErrors(['error' => "Erro ao enviar email"]);
    }

    /**
     * Exibe a view para inserir a nova password (com token).
     */
    public function showResetForm($token, Request $request)
    {
        return view('client.RecoverPassword', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Efetua o reset da password.
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return redirect(route('login'))->with("success", "Password Alterada com Sucesso!");
            }

            return back()->withErrors(['error' => __($status)]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocorreu um erro ao redefinir a sua password. Por favor, tente novamente.'])->withInput();
        }
    }
}
