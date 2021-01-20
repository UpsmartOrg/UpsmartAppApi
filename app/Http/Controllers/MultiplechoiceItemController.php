<?php

namespace App\Http\Controllers;

use App\MultiplechoiceItem;
use Illuminate\Http\Request;

class MultiplechoiceItemController extends Controller
{
    public function index()
    {
        return MultiplechoiceItem::all();
    }

    public function show(MultiplechoiceItem $multiplechoiceItem)
    {
        return $multiplechoiceItem;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'multiplechoice_question_id'    => ['required', 'integer', 'exists:multiplechoice_questions,id'],
                'title'                         => ['required', 'min:6', 'max:255', 'string'],
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
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

        $multiplechoiceItem = MultiplechoiceItem::create($request->all());

        return response()->json($multiplechoiceItem, 201);
    }

    public function update(Request $request, MultiplechoiceItem $multiplechoiceItem)
    {
        $validator = Validator::make($request->all(),
            [
                'multiplechoice_question_id'    => ['required', 'integer', 'exists:multiplechoice_questions,id'],
                'title'                         => ['required', 'min:6', 'max:255', 'string'],
            ],
            [
                'required'                      => ':attribute moet ingevuld zijn',
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

        $multiplechoiceItem->update($request->all());

        return response()->json($multiplechoiceItem, 200);
    }

    public function delete(MultiplechoiceItem $multiplechoiceItem)
    {
        $multiplechoiceItem->delete();

        return response()->json(null, 204);
    }
}
