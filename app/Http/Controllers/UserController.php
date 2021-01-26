<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function indexWithRoles()
    {
        return User::all()
            ->loadMissing('userRoles')
            ->loadMissing('userRoles.role');
    }

    public function show(User $user)
    {
        return $user;
    }

    public function showWithRoles(User $user)
    {
        return $user->loadMissing('userRoles');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'                => ['required', 'min:2', 'max:255', 'string'],
                'last_name'                 => ['required', 'min:2', 'max:255', 'string'],
                'email'                     => ['required', 'min:2', 'max:255', 'email', 'unique:users,email'],
                'username'                  => ['required', 'min:2', 'max:255', 'string', 'unique:users,username'],
                'password'                  => ['required', 'min:8', 'max:255', 'string', 'confirmed'],
            ],
            [
                'required'                  => 'Je moet :attribute invullen',
                'min'                       => ':attribute moet minstens 2 karakters lang zijn',
                'password.min'              => ':attribute moet minstens 8 karakters lang zijn',
                'max'                       => ':attribute mag maximum 255 karakters lang zijn',
                'string'                    => ':attribute moet een string zijn',
                'email'                     => ':attribute moet een geldig email zijn',
                'unique'                    => ':attribute is al in gebruik',
                'confirmed'                 => ':attribute is niet gecomfirmeerd'
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($request['password']);
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function storeWithRoles(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'                => ['required', 'min:2', 'max:255', 'string'],
                'last_name'                 => ['required', 'min:2', 'max:255', 'string'],
                'email'                     => ['required', 'min:2', 'max:255', 'email', 'unique:users,email'],
                'username'                  => ['required', 'min:2', 'max:255', 'string', 'unique:users,username'],
                'password'                  => ['required', 'min:8', 'max:255', 'string', 'confirmed'],
            ],
            [
                'required'                  => 'Je moet :attribute invullen',
                'min'                       => ':attribute moet minstens 2 karakters lang zijn',
                'password.min'              => ':attribute moet minstens 8 karakters lang zijn',
                'max'                       => ':attribute mag maximum 255 karakters lang zijn',
                'string'                    => ':attribute moet een string zijn',
                'email'                     => ':attribute moet een geldig email zijn',
                'unique'                    => ':attribute is al in gebruik',
                'confirmed'                 => ':attribute is niet gecomfirmeerd'
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($request['password']);
        $user = User::create($request->all());

        //Loop through all user_roles in the request and add them as new userRole
        foreach ($request->user_roles as $user_role) {
            $newRole = new UserRole();
            $newRole->user_id = $user->id;
            $newRole->role_id = $user_role['role_id'];
            $newRole->save();
        }

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'                => ['required', 'min:2', 'max:255', 'string'],
                'last_name'                 => ['required', 'min:2', 'max:255', 'string'],
                'email'                     => ['required', 'min:2', 'max:255', 'email', 'unique:users,email,' .$user->id],
                'username'                  => ['required', 'min:2', 'max:255', 'string', 'unique:users,username,' .$user->id],
            ],
            [
                'required'                  => 'Je moet :attribute invullen',
                'min'                       => ':attribute moet minstens 2 karakters lang zijn',
                'max'                       => ':attribute mag maximum 255 karakters lang zijn',
                'string'                    => ':attribute moet een string zijn',
                'unique'                    => ':attribute is al in gebruik',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password'] = $user->password;
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function updateWithRoles(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'                => ['required', 'min:2', 'max:255', 'string'],
                'last_name'                 => ['required', 'min:2', 'max:255', 'string'],
                'email'                     => ['required', 'min:2', 'max:255', 'email', 'unique:users,email,' .$user->id],
                'username'                  => ['required', 'min:2', 'max:255', 'string', 'unique:users,username,' .$user->id],
            ],
            [
                'required'                  => 'Je moet :attribute invullen',
                'min'                       => ':attribute moet minstens 2 karakters lang zijn',
                'max'                       => ':attribute mag maximum 255 karakters lang zijn',
                'string'                    => ':attribute moet een string zijn',
                'unique'                    => ':attribute is al in gebruik',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $requestUserRoles = [];
        //Loop through all user_roles in the request, if they have id 0/null add them as new userRole
        //If they do have an id, add them to the array to compare to current userRoles
        foreach ($request->user_roles as $user_role) {
            if(!$user_role['id'] || $user_role['id'] == 0) {
                $user_role = UserRole::create($user_role);
                //Add it to array so it doesn't get deleted later
                array_push($requestUserRoles, $user_role->id);
            }else {
                array_push($requestUserRoles, $user_role['id']);
            }
        }

        $currentUserRoles = UserRole::where('user_id', $user->id)->get();
        foreach ($currentUserRoles as $currentUserRole) {
            if(!in_array($currentUserRole->id, $requestUserRoles)) {
                //If the current role is not in the array, delete it
                $currentUserRole->delete();
            }
        }

        $request['password'] = $user->password;
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $userRoles = UserRole::where('user_id', $user->id)->get();
        foreach ($userRoles as $userRole) {
            $userRole->delete();
        }

        $user->delete();

        return response()->json(null, 204);
    }

}
