<?php

namespace App\Http\Controllers;

use App\ConductedSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConductedSurveyController extends Controller
{
    public function index()
    {
        return ConductedSurvey::all();
    }

    public function show(ConductedSurvey $conductedSurvey)
    {
        return $conductedSurvey;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'survey_id'                     => ['required', 'integer', 'exists:surveys,id'],
                'conducted_on'                  => ['required', 'date']
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'date'                          => ':attribute moet een datum zijn',
                'integer'                       => ':attribute moet een integer zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $conductedSurvey = ConductedSurvey::create($request->all());

        return response()->json($conductedSurvey, 201);
    }

    public function update(Request $request, ConductedSurvey $conductedSurvey)
    {
        $validator = Validator::make($request->all(),
            [
                'survey_id'                     => ['required', 'integer', 'exists:surveys,id'],
                'conducted_on'                  => ['required', 'date']
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'date'                          => ':attribute moet een datum zijn',
                'integer'                       => ':attribute moet een integer zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $conductedSurvey->update($request->all());

        return response()->json($conductedSurvey, 200);
    }

    public function delete(ConductedSurvey $conductedSurvey)
    {
        $conductedSurvey->delete();

        return response()->json(null, 204);
    }
}
