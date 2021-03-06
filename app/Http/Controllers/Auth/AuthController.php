<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{

    public function login (Request $request) {
        $validator = Validator::make($request->all(),
            [
                'email'                         => ['required'],
                'password'                      => ['required']
            ],
            [
                'required'                      => 'Je moet een email of username invullen',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user){
            $user = User::where('username', $request->email)->first();
        }

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken');
                $user->token = $token->plainTextToken;
                return response($user, 200);
            }
        }

        $response = ["message" =>'Login mislukt. Onjuiste login gegevens.'];
        return response($response, 422);
    }

    public function logout (Request $request) {
        $request->user()->tokens()->delete();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
