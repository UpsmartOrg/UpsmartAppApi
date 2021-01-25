<?php

namespace App\Http\Controllers;

use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    public function index()
    {
        return UserRole::all();
    }

    public function show(UserRole $userRole)
    {
        return $userRole;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                   => ['required', 'integer', 'exists:users,id'],
                'role_id'                   => ['required', 'integer', 'exists:roles,id']
            ],
            [
                'required'                  => 'Je moet :attribute invullen',
                'integer'                   => ':attribute moet een integer zijn',
                'exists'                    => ':attribute bestaat niet in de tabel'
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $userRole = UserRole::create($request->all());

        return response()->json($userRole, 201);
    }

    public function update(Request $request, UserRole $userRole)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                   => ['required', 'integer', 'exists:users,id'],
                'role_id'                   => ['required', 'integer', 'exists:roles,id']
            ],
            [
                'required'                  => 'Je moet :attribute invullen',
                'integer'                   => ':attribute moet een integer zijn',
                'exists'                    => ':attribute bestaat niet in de tabel'
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $userRole->update($request->all());

        return response()->json($userRole, 200);
    }

    public function delete(UserRole $userRole)
    {
        $userRole->delete();

        return response()->json(null, 204);
    }
}
