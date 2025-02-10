<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Notifications\AccountCreated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterApiController extends BaseController
{
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erro de validação.', $validator->errors(), 400);
        }

        // Creating User with default values for optional fields
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nif' => $request->nif ?? null,
            'phone_number' => $request->phone_number ?? null,
            'address' => $request->address ?? null,
            'postal_code' => $request->postal_code ?? null,
            'locality' => $request->locality ?? null,
            'security_token' => Str::random(6)
        ]);

        // Generate Token
        $success = [
            'id' => $user->id,
            'token' => $user->createToken('EditArtToken')->plainTextToken,
            'name' => $user->name,
            'email' => $user->email,
            'nif' => $user->nif,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
            'postal_code' => $user->postal_code,
            'locality' => $user->locality,
            'created_at' => $user->created_at,
            'security_token' => $user->security_token,
        ];

        $user->notify(new AccountCreated($user));

        return $this->sendResponse($success, 'Usuário registrado com sucesso.');
    }
}
