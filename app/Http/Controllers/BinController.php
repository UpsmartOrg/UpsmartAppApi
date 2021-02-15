<?php

namespace App\Http\Controllers;

use App\Bin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BinController extends Controller
{
    public function index()
    {
        $binList = Bin::select(['ID AS bin_id', 'longitude', 'latitude'])->distinct()->get()->toArray();

        return $binList;
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
