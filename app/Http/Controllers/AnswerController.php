<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        return Answer::all();
    }

    public function show(Answer $answer)
    {
        return $answer;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'conducted_survey_id'           => ['required', 'integer', 'exists:conducted_surveys,id'],
                'open_question_id'              => ['integer', 'exists:open_questions,id'],
                'open_question_answer'          => ['required_if:open_question_id', 'min:6', 'max:255', 'string'],
                'multiplechoice_item_id'        => ['integer', 'exists:multiplechoice_items,id'],
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'required_if'                   => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'integer'                       => ':attribute moet een integer zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $answer = Answer::create($request->all());

        return response()->json($answer, 201);
    }

    public function update(Request $request, Answer $answer)
    {
        $validator = Validator::make($request->all(),
            [
                'conducted_survey_id'           => ['required', 'integer', 'exists:conducted_surveys,id'],
                'open_question_id'              => ['integer', 'exists:open_questions,id'],
                'open_question_answer'          => ['required_if:open_question_id', 'min:6', 'max:255', 'string'],
                'multiplechoice_item_id'        => ['integer', 'exists:multiplechoice_items,id'],
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
                'required_if'                   => ':attribute moet ingevuld zijn',
                'exists'                        => ':attribute bestaat niet binnen users',
                'min'                           => ':attribute moet minstens 6 karakters lang zijn',
                'max'                           => ':attribute mag maximum 255 karakters lang zijn',
                'string'                        => ':attribute moet een string zijn',
                'integer'                       => ':attribute moet een integer zijn',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $answer->update($request->all());

        return response()->json($answer, 200);
    }

    public function delete(Answer $answer)
    {
        $answer->delete();

        return response()->json(null, 204);
    }
}
