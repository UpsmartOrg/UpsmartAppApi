<?php

namespace App\Http\Controllers;

use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
    public function index()
    {
        return Zone::all();
    }

    public function show(Zone $zone)
    {
        return $zone;
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

        $zone = Zone::create($request->all());

        return response()->json($zone, 201);
    }

    public function update(Request $request, Zone $zone)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'min:2', 'max:255', 'string', 'unique:zones,name,' .$zone->id],
                'description'           => ['max:255', 'string'],
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
        $zone->update($request->all());

        return response()->json($zone, 200);
    }

    public function delete(Zone $zone)
    {
        $zone->delete();

        return response()->json(null, 204);
    }
}
