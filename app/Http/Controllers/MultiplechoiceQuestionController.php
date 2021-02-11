<?php

namespace App\Http\Controllers;

use App\MultiplechoiceQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MultiplechoiceQuestionController extends Controller
{
    public function index()
    {
        return MultiplechoiceQuestion::all();
    }

    public function show(MultiplechoiceQuestion $multiplechoiceQuestion)
    {
        return $multiplechoiceQuestion;
    }

    public function showFromSurvey($surveyID){
        return MultiplechoiceQuestion::where('survey_id', $surveyID)->get();
    }

    public function showQuickSurvey(){
        return MultiplechoiceQuestion::whereHas('survey', function($query){
            return $query->where('quick_survey', '=', true);
        })->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'survey_id'                     => ['required', 'integer', 'exists:surveys,id'],
                'title'                         => ['required', 'min:6', 'max:255', 'string'],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
                'multiple_answers'              => ['boolean'],
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'integer'                       => ':attribute moet een integer zijn',
                'boolean'                       => ':attribute moet een boolean zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $multiplechoiceQuestion = MultiplechoiceQuestion::create($request->all());

        return response()->json($multiplechoiceQuestion, 201);
    }

    public function update(Request $request, MultiplechoiceQuestion $multiplechoiceQuestion)
    {
        $validator = Validator::make($request->all(),
            [
                'survey_id'                     => ['required', 'integer', 'exists:surveys,id'],
                'title'                         => ['required', 'min:6', 'max:255', 'string'],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
                'is_dropdown'                   => ['boolean'],
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'integer'                       => ':attribute moet een integer zijn',
                'boolean'                       => ':attribute moet een boolean zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $multiplechoiceQuestion->update($request->all());

        return response()->json($multiplechoiceQuestion, 200);
    }

    public function delete(MultiplechoiceQuestion $multiplechoiceQuestion)
    {
        $multiplechoiceQuestion->delete();

        return response()->json(null, 204);
    }
}
