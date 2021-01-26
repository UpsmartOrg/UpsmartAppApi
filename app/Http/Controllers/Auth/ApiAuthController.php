<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
//    public function register (Request $request) {
//
//        $validator = Validator::make($request->all(),
//            [
//                'first_name'                => ['required', 'min:2', 'max:255', 'string'],
//                'last_name'                 => ['required', 'min:2', 'max:255', 'string'],
//                'email'                     => ['required', 'min:2', 'max:255', 'email', 'unique:users'],
//                'password'                  => ['required', 'min:8', 'max:255', 'string', 'confirmed']
//            ],
//            [
//                'required'       => 'Je moet :attribute invullen',
//                'min'            => ':attribute moet minstens 2 karakters lang zijn',
//                'password.min'   => ':attribute moet minstens 8 karakters lang zijn',
//                'max'            => ':attribute mag maximum 255 karakters lang zijn',
//                'string'         => ':attribute moet een string zijn',
//                'email'          => ':attribute moet een e-mail zijn',
//                'unique'         => ':attribute moet uniek zijn binnen rollen',
//                'confirmed'      => ':attribute is niet gecomfirmeerd'
//            ]);
//        //On validation fail
//        if ($validator->fails())
//        {
//            return response(['errors'=>$validator->errors()->all()], 422);
//        }
//
//        $request['password'] = Hash::make($request['password']);
//        $request['remember_token'] = Str::random(10);
//        $request['role_id'] = 1;
//        $user = User::create($request->toArray());
//        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
//        $response = ['token' => $token];
//        return response($response, 200);
//    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|max:255',
            ],
            [
                'required'       => 'Je moet :attribute invullen',
                'email'       => ':attribute moet een email zijn',
                'max'            => ':attribute mag maximum 255 karakters lang zijn',
                'string'         => ':attribute moet een string zijn',
                'unique'         => ':attribute moet uniek zijn binnen rollen',
                'confirmed'      => ':attribute is niet gecomfirmeerd'
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                $user->makeHidden('id');
                $user->makeHidden('created_at');
                $user->token = $token;
                $user->loadMissing('userRoles');

                return response()->json($user, 200);
            }
        }

        // Als user niet bestaat of wachtwoord niet klopt
        $response = ["message" => "Inloggen niet gelukt, check wachtwoord of e-mail"];
        return response($response, 422);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
