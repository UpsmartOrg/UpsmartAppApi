<?php

namespace App\Http\Controllers;

use App\Bin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BinController extends Controller
{
    public function index()
    {
        return Bin::all();
    }

    public function indexUnique()
    {
        return Bin::all();
    }

    public function show(Bin $bin)
    {
        return $bin;
    }
}
