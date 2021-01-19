<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

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
        $role = Role::create($request->all());

        return response()->json($role, 201);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        return response()->json($role, 200);
    }

    public function delete(Role $role)
    {
        $role->delete();

        return response()->json(null, 204);
    }
}
