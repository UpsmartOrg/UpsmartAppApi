<?php

namespace App\Http\Controllers;

use App\Bin;
use App\BinInfo;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Sodium\add;

class BinInfoController extends Controller
{
    public function index()
    {
        return BinInfo::all();
    }

    public function indexByZone(Zone $zone)
    {
        return BinInfo::where('zone_id', $zone->id)->get();
    }

    public function indexNoZone()
    {
        return BinInfo::whereNull('zone_id')->get();
    }

    public function show(BinInfo $binInfo)
    {
        return $binInfo;
    }

    public function loadNewBins()
    {
        $binInfoCount = BinInfo::count('bin_id');
        $binCount = Bin::distinct()->count('ID');

        if($binInfoCount < $binCount) {

            $binList = BIN::select(['ID AS bin_id'])->distinct()->get()->toArray();
            $binInfoList = BinInfo::select(['bin_id'])->distinct()->get()->toArray();

            $newBinInfoList = [];
            foreach ($binList as $bin) {
                if (!in_array($bin, $binInfoList)) {
                    $newBinInfo = new BinInfo();
                    $newBinInfo->bin_id = $bin['bin_id'];
                    $newBinInfo->name = 'vuilbak-' . str_random(6);
                    //Just in case the string matches an existing bin
                    while (BinInfo::where('name', $newBinInfo->name)->count() > 0) {
                        $newBinInfo->name = 'vuilbak-' . str_random(6);
                    }

                    $newBinInfo->save();
                    array_push($newBinInfoList, $newBinInfo);
                }
            }
            return response()->json($newBinInfoList, 201);
        }

        $return = 'Alle vuilbakken zijn toegevoegd';
        return response()->json($return, 200);
    }

    public function update(Request $request, BinInfo $binInfo)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'min:2', 'max:255', 'string', 'unique:bin_info,name,' .$binInfo->id],
                'address'               => ['max:255', 'string'],
                'zone_id'               => ['integer', 'exists:zones,id'],
            ],
            [
                'required'              => 'Je moet :attribute invullen',
                'min'                   => ':attribute moet minsters 2 karakters lang zijn',
                'max'                   => ':attribute mag maximum 255 karakters lang zijn',
                'string'                => ':attribute moet een string zijn',
                'integer'               => ':attribute moet een integer zijn',
                'unique'                => ':attribute moet uniek zijn binnen rollen',
                'exists'                => ':attribute bestaat niet in onze data',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $binInfo->name = $request->name;
        $binInfo->address = $request->address;
        $binInfo->zone_id = $request->zone_id;

        $binInfo->update();

        return response()->json($binInfo, 200);
    }

    public function updateZone(Request $request, BinInfo $binInfo)
    {
        $validator = Validator::make($request->all(),
            [
                'zone_id'               => ['integer', 'exists:zones,id']
            ],
            [
                'integer'               => ':attribute moet een integer zijn',
                'exists'                => ':attribute bestaat niet in onze data',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $binInfo->zone_id = $request->new_zone_id;

        $binInfo->update();

        return response()->json($binInfo, 200);
    }

    public function delete(BinInfo $binInfo)
    {
        $binInfo->delete();

        return response()->json(null, 204);
    }
}
