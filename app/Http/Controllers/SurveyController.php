<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    public function index()
    {
        return Survey::all();
    }

    public function show(Survey $survey)
    {
        return $survey;
    }

    public function showComplete(Survey $survey)
    {
        return $survey->loadMissing(['openQuestions', 'multiplechoiceQuestions']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                       => ['required', 'integer', 'exists:users,id'],
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys'],
                'description'                   => ['required', 'min:6', 'max:255', 'integer'],
                'start_date'                    => ['required', 'date', 'after_or_equal:now'],
                'end_date'                      => ['required', 'date', 'after_or_equal:start_date']
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'date'                          => ':attribute moet een geldige datum zijn',
                'integer'                       => ':attribute moet een integer zijn',
                'unique'                        => ':attribute is al in gebruik',
                'start_date.after_or_equal'     => ':attribute mag niet in het verleden vallen',
                'end_date.after_or_equal'       => ':attribute moet na de startdatum vallen'

            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $survey = Survey::create($request->all());

        return response()->json($survey, 201);
    }

    public function update(Request $request, Survey $survey)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                       => ['required', 'integer', 'exists:users,id'],
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys' .$survey->name],
                'description'                   => ['required', 'min:6', 'max:255', 'integer'],
                'start_date'                    => ['required', 'date'],
                'end_date'                      => ['required', 'date', 'after_or_equal:start_date']
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'date'                          => ':attribute moet een geldige datum zijn',
                'integer'                       => ':attribute moet een integer zijn',
                'unique'                        => ':attribute is al in gebruik',
                'after_or_equal'                => ':attribute moet na de startdatum vallen'

            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $survey->update($request->all());

        return response()->json($survey, 200);
    }

    public function delete(Survey $survey)
    {
        $survey->delete();

        return response()->json(null, 204);
    }
}
