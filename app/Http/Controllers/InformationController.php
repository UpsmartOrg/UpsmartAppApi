<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function index()
    {
        return Information::all();
    }

    public function indexUser()
    {
        return Information::all()->loadMissing('user');
    }

    public function show(Information $information)
    {
        return $information;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'               => ['required', 'integer', 'exists:users,id'],
                'title'                 => ['required', 'min:2', 'max:255', 'string'],
                'body'                  => ['required', 'min:2', 'max:255', 'string'],
            ],
            [
                'required'              => 'Je moet :attribute invullen',
                'min'                   => ':attribute moet minsters 2 karakters lang zijn',
                'max'                   => ':attribute mag maximum 255 karakters lang zijn',
                'string'                => ':attribute moet een string zijn',
                'integer'               => ':attribute moet een integer zijn',
                'exists'                => ':attribute bestaat niet binnen users',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $information = Information::create($request->all());

        return response()->json($information, 201);
    }

    public function update(Request $request, Information $information)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'               => ['required', 'integer', 'exists:users,id'],
                'title'                 => ['required', 'min:2', 'max:255', 'string'],
                'body'                  => ['required', 'min:2', 'max:255', 'string'],
            ],
            [
                'required'              => 'Je moet :attribute invullen',
                'min'                   => ':attribute moet minsters 2 karakters lang zijn',
                'max'                   => ':attribute mag maximum 255 karakters lang zijn',
                'string'                => ':attribute moet een string zijn',
                'integer'               => ':attribute moet een integer zijn',
                'exists'                => ':attribute bestaat niet binnen users',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $information->update($request->all());

        return response()->json($information, 200);
    }

    public function delete(Information $information)
    {
        $information->delete();

        return response()->json(null, 204);
    }}
