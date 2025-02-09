<?php

namespace App\Http\Controllers\Client;

use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected function getValidationRules(?User $user = null): array
    {
        $id = $user ? $user->id : 'NULL';

        return [
            'name' => 'required|min:3|max:50',
            'address' => 'max:255',
            'nif' => 'required|digits:9|unique:users,nif,' . $id,
            'phone_number' => 'required|regex:/^\d{9,15}$/|unique:users,phone_number,' . $id . ',id',
            'password' => $user ? 'nullable|min:8|max:50' : 'required|min:8|max:50',
            'locality' => 'max:255',
            'postal_code' => 'regex:/^\d{4}(-\d{3})?$/',
        ];
    }


    protected array $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'name.max' => 'O nome não pode ter mais de 50 caracteres.',

        'address.max' => 'A morada não pode ter mais de 255 caracteres.',

        'nif.required' => 'O NIF é obrigatório.',
        'nif.digits' => 'O NIF deve conter exatamente 9 dígitos.',
        'nif.unique' => 'Este NIF já está cadastrado.',

        'phone_number.required' => 'O número de telefone é obrigatório.',
        'phone_number.regex' => 'Insira um número de telefone válido com 9 a 15 dígitos.',
        'phone_number.unique' => 'Este número de telefone já está cadastrado.',

        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        'password.max' => 'A senha não pode ter mais de 50 caracteres.',
    ];

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate($this->getValidationRules($user),$this->messages);
        try{
            if ($request->filled('password')) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']);
            }
            $user->update($validated);
            return redirect(route('client.profile',$user))->with(['success','Perfil atualizado com sucesso!']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>"Erro ao atualizar o perfil! MSG:{$e->getMessage()}"])->withInput();
        }

    }
    public function showProfile()
    {
        $user = auth()->user();
        $reviews = Review::with(['user', 'book'])->where('user_id', $user->id)->get();
        $transactions = Transaction::with(['user'])->where('user_id', $user->id)->get();

        return view('client.profile', compact('reviews','transactions'));
    }

}
