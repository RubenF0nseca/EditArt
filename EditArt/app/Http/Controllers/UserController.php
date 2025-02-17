<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function getValidationRules(?User $user = null): array
    {
        $id = $user ? $user->id : 'NULL';

        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'address' => 'max:255',
            'locality' => 'max:50',
            'postal_code' => 'regex:/^\d{4,10}(-\d{3,5})?$/',
            'nif' => 'digits:9|unique:users,nif,' . $id,
            'phone_number' => 'regex:/^\d{9,15}$/|unique:users,phone_number,' . $id,
            'birthdate' => 'date|before:today',
            'password' => $user ? 'nullable|min:8|max:50' : 'required|min:8|max:50',
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

        'locality.max' => 'A localidade não pode ter mais de 50 caracteres.',

        'postal_code' => 'O código postal deve ter um formato válido, como 12345 ou 1234-567.',

        'nif.digits' => 'O NIF deve conter exatamente 9 dígitos.',
        'nif.unique' => 'Este NIF já está cadastrado.',

        'phone_number.regex' => 'Insira um número de telefone válido com 9 a 15 dígitos.',

        'birthdate.date' => 'Insira uma data de nascimento válida.',
        'birthdate.before' => 'A data de nascimento deve ser anterior à data atual.',

        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        'password.max' => 'A senha não pode ter mais de 50 caracteres.',


    ];


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $usersQuery = User::query();

        if (!empty($name)) {
            $usersQuery->name($name);
        }

        $users = $usersQuery->paginate(12);

        return view('client.index', [
            'users' => $users,
            'searchQuery' => $name,
        ]);
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
        $validated = $request->validate($this->getValidationRules(), $this->messages);
        try{
            $user = new User($validated);
            $user->save();
            $user->assignRole('cliente');
            return redirect(route('admin.users.create'))->with('success',"User criado com sucesso! [#{$user->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar o User!"])->withInput();
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
    public function edit(User $user)
    {
        return view('client.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate($this->getValidationRules($user),$this->messages);
        try{
            if ($request->filled('password')) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']);
            }
            $user->update($validated);
            return redirect(route('admin.users.show',$user))->with(['success','Utilizador atualizado com sucesso!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>"Erro ao editar o utilizador! MSG:{$e->getMessage()}"])->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}
