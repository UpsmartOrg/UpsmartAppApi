<?php

namespace App\Http\Controllers;

use App\OpenQuestion;
use Illuminate\Http\Request;

class OpenQuestionController extends Controller
{
    public function index()
    {
        return OpenQuestion::all();
    }

    public function show(OpenQuestion $openQuestion)
    {
        return $openQuestion;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'survey_id'                     => ['required', 'integer', 'exists:surveys,id'],
                'title'                         => ['required', 'min:6', 'max:255', 'string'],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
                'rows'                          => ['required', 'integer', 'min:1']
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'rows.min'                      => ':attribute moet minstens 1 zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'integer'                       => ':attribute moet een integer zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $openQuestion = OpenQuestion::create($request->all());

        return response()->json($openQuestion, 201);
    }

    public function update(Request $request, OpenQuestion $openQuestion)
    {
        $validator = Validator::make($request->all(),
            [
                'survey_id'                     => ['required', 'integer', 'exists:surveys,id'],
                'title'                         => ['required', 'min:6', 'max:255', 'string'],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
                'rows'                          => ['required', 'integer', 'min:1']
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'rows.min'                      => ':attribute moet minstens 1 zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'integer'                       => ':attribute moet een integer zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $openQuestion->update($request->all());

        return response()->json($openQuestion, 200);
    }

    public function delete(OpenQuestion $openQuestion)
    {
        $openQuestion->delete();

        return response()->json(null, 204);
    }
}
