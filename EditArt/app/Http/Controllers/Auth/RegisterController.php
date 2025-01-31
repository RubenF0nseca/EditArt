<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\AccountCreated;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected function getValidationRules(?User $user = null): array
    {
        $id = $user ? $user->id : 'NULL';

        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'address' => 'nullable|max:255',
            'nif' => 'nullable|digits:9|unique:users,nif,' . $id,
            'phone_number' => 'nullable|regex:/^\d{9,15}$/|unique:users,phone_number,' . $id,
            'birthdate' => 'nullable|date|before:today',
            'password' => $user ? 'nullable|min:8|max:50|confirmed' : 'required|min:8|max:50|confirmed',
        ];
    }


    protected array $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'name.max' => 'O nome não pode ter mais de 50 caracteres.',

        'email.required' => 'O email é obrigatório.',
        'email.email' => 'Insira um email válido.',
        'email.max' => 'O email não pode ter mais de 100 caracteres.',
        'email.unique' => 'Este email já está cadastrado.',

        'address.max' => 'A morada não pode ter mais de 255 caracteres.',

        'nif.digits' => 'O NIF deve conter exatamente 9 dígitos.',
        'nif.unique' => 'Este NIF já está cadastrado.',

        'phone_number.regex' => 'Insira um número de telefone válido com 9 a 15 dígitos.',

        'birthdate.date' => 'Insira uma data de nascimento válida.',
        'birthdate.before' => 'A data de nascimento deve ser anterior à data atual.',

        'password.required' => 'A password é obrigatória.',
        'password.min' => 'A password deve ter pelo menos 8 caracteres.',
        'password.max' => 'A password não pode ter mais de 50 caracteres.',
        'password.confirmed' => 'As passwords não coincidem.',

    ];
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);

        try{
            $user = new User($validated);
            $user->save();
            $user->assignRole('cliente');
            $user->notify(new AccountCreated($user->name));
            return redirect(route('login'))->with('success',"Conta criada com sucesso!");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar a conta"])->withInput();
        }
    }
}
