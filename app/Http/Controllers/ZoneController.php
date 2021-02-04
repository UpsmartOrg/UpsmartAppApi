<?php

namespace App\Http\Controllers;

use App\BinInfo;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
    public function index()
    {
        return Zone::all();
    }

    public function indexWithBins()
    {
        return Zone::all()->loadMissing('binInfo');
    }

    public function show(Zone $zone)
    {
        return $zone;
    }

    public function showWithBins(Zone $zone)
    {
        return $zone->loadMissing('binInfo');;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'min:2', 'max:255', 'string', 'unique:zones,name'],
                'description'           => ['max:255', 'string'],
            ],
            [
                'required'              => 'Je moet :attribute invullen',
                'min'                   => ':attribute moet minsters 2 karakters lang zijn',
                'max'                   => ':attribute mag maximum 255 karakters lang zijn',
                'string'                => ':attribute moet een string zijn',
                'unique'                => 'Er bestaat al een zone met deze naam',
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
                'unique'                => 'Er bestaat al een zone met deze naam',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $zone->description = $request->description;
        $zone->update($request->all());

        return response()->json($zone, 200);
    }

    public function updateZoneBins(Request $request, Zone $zone)
    {
        $validator = Validator::make($request->all(),
            [
                'bin_id_list'           => ['array'],
            ],
            [
                'array'                 => ':attribute moet een array zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        if(!$request->bin_id_list) {
            $request->bin_id_list = [];
        }

        foreach ($request->bin_id_list as $binID) {
            $bin = BinInfo::findOrFail($binID);

            $bin->zone_id = $zone->id;

            $bin->update();
        }

        $toRemoveBins = $zone->binInfo->whereNotIn('id', $request->bin_id_list);
        foreach ($toRemoveBins as $toRemoveBins) {
            $toRemoveBins->zone_id = null;
            $toRemoveBins->update();
        }

        return response()->json($zone->binInfo, 200);
    }

    public function delete(Zone $zone)
    {
        foreach ($zone->binInfo as $binInfo) {
            $binInfo->zone_id = null;
            $binInfo->update();
        }
        $zone->delete();

        return response()->json(null, 204);
    }
}
