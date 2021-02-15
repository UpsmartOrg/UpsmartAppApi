<?php

namespace App\Http\Controllers;

use App\Bin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BinController extends Controller
{
    public function index()
    {
        $binList = Bin::select(['ID as bin_id'])
            ->distinct()
            ->get()
            ->toArray();
        
        $returnList = [];
        foreach ($binList as $bin) {
            $bin = Bin::where('ID', $bin['bin_id'])
                ->whereNotNull(['longitude', 'latitude'])
                ->orderByDesc('tijd')
                ->select(['ID as bin_id', 'longitude', 'latitude'])
                ->firstOrFail();
            array_push($returnList, $bin);
        }

        return $returnList;
    }

    public function indexAllBins()
    {
        return Bin::all();
    }

    public function test()
    {
        return 'Test successfully completed!';
    }

    public function show(Bin $bin)
    {
        return $bin;
    }
}
