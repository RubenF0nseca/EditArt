<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginApiController extends BaseController
{
    public function login(Request $request){
        if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('EditArtToken')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['nif'] = $user->nif;
            $success['phone_number'] = $user->phone_number;
            $success['address'] = $user->address;
            $success['postal_code'] = $user->postal_code;
            $success['locality'] = $user->locality;
            $success['created_at'] = $user->created_at;
            $success['role'] = $user->getRoleNames()->first();
            $success['security_token'] = $user->security_token;
            return $this->sendResponse($success, 'Login efetuado com sucesso.');
        }
        else return $this->sendError("Acesso não autorizado.",null, 401);
    }
}
