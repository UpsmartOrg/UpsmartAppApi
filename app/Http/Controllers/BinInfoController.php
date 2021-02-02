<?php

namespace App\Http\Controllers;

use App\BinInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BinInfoController extends Controller
{
    public function index()
    {
        return BinInfo::all();
    }

    public function show(BinInfo $binInfo)
    {
        return $binInfo;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'min:2', 'max:255', 'string', 'unique:bin_info,name'],
                'bin_id'                => ['required', 'integer', 'exists:DataSensoren,ID'],
                'zone_id'               => ['integer', 'exists:zones,id'],
            ],
            [
                'required'              => 'Je moet :attribute invullen',
                'min'                   => ':attribute moet minsters 2 karakters lang zijn',
                'max'                   => ':attribute mag maximum 255 karakters lang zijn',
                'string'                => ':attribute moet een string zijn',
                'integer'               => ':attribute moet een integer zijn',
                'unique'                => ':attribute moet uniek zijn binnen rollen',
                'exists'                => ':attribute bestaat niet in de data',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $binInfo = BinInfo ::create($request->all());

        return response()->json($binInfo, 201);
    }

    public function update(Request $request, BinInfo $binInfo)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'min:2', 'max:255', 'string', 'unique:bin_info,name,' .$binInfo->id],
                'bin_id'                => ['required', 'integer', 'exists:DataSensoren,ID'],
                'zone_id'               => ['integer', 'exists:zones,id'],
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
        $binInfo->update($request->all());

        return response()->json($binInfo, 200);
    }

    public function delete(BinInfo $binInfo)
    {
        $binInfo->delete();

        return response()->json(null, 204);
    }
}
