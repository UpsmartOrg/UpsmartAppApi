<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'min:2', 'max:255', 'string', 'unique:roles,name'],
                'description'           => ['required', 'min:2', 'max:255', 'string'],
            ],
            [
                'required'              => 'Je moet :attribute invullen',
                'min'                   => ':attribute moet minsters 2 karakters lang zijn',
                'max'                   => ':attribute mag maximum 255 karakters lang zijn',
                'string'                => ':attribute moet een string zijn',
                'unique'                => ':attribute moet uniek zijn binnen rollen',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $role = Role::create($request->all());

        return response()->json($role, 201);
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                => ['required', 'min:2', 'max:255', 'string', 'unique:roles,name,' .$role->id],
                'description'           => ['required', 'min:2', 'max:255', 'string'],
            ],
            [
                'required'       => 'Je moet :attribute invullen',
                'min'            => ':attribute moet minsters 2 karakters lang zijn',
                'max'            => ':attribute mag maximum 255 karakters lang zijn',
                'string'         => ':attribute moet een string zijn',
                'unique'         => ':attribute moet uniek zijn binnen rollen',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $role->update($request->all());

        return response()->json($role, 200);
    }

    public function delete(Role $role)
    {
        $role->delete();

        return response()->json(null, 204);
    }
}
