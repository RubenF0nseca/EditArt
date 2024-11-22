<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected array $rules = [
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|max:100|unique:users,email',
        'address' => 'required|max:255',
        'nif' => 'required|digits:9|unique:users,nif',
        'phone_number' => 'required|regex:/^\d{9,15}$/',
        'birthdate' => 'required|date|before:today',
        'password' => 'required|min:8|max:50',
        'role' => 'required|integer|between:1,5',
    ];


    protected array $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'name.max' => 'O nome não pode ter mais de 50 caracteres.',

        'email.required' => 'O email é obrigatório.',
        'email.email' => 'Insira um email válido.',
        'email.max' => 'O email não pode ter mais de 100 caracteres.',
        'email.unique' => 'Este email já está cadastrado.',

        'address.required' => 'A morada é obrigatória.',
        'address.max' => 'A morada não pode ter mais de 255 caracteres.',

        'nif.required' => 'O NIF é obrigatório.',
        'nif.digits' => 'O NIF deve conter exatamente 9 dígitos.',
        'nif.unique' => 'Este NIF já está cadastrado.',

        'phone_number.required' => 'O número de telefone é obrigatório.',
        'phone_number.regex' => 'Insira um número de telefone válido com 9 a 15 dígitos.',

        'birthdate.required' => 'A data de nascimento é obrigatória.',
        'birthdate.date' => 'Insira uma data de nascimento válida.',
        'birthdate.before' => 'A data de nascimento deve ser anterior à data atual.',

        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        'password.max' => 'A senha não pode ter mais de 50 caracteres.',

        'role.required' => 'O tipo de utilizador é obrigatório.',
        'role.in' => 'Selecione um tipo de utilizador válido: admin, user ou moderator.',
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules, $this->messages);
        try{
            $user = new User($validated);
            $user->save();
            return redirect(route('users.create'))->with('success',"Tipo de Obra registada com sucesso! [#{$user->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar um User!"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('client.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
