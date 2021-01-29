<?php

namespace App\Http\Controllers;

use App\MultiplechoiceItem;
use App\MultiplechoiceQuestion;
use App\OpenQuestion;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    public function index()
    {
        return Survey::all();
    }

    public function indexWithUser()
    {
        return Survey::all()
            ->loadMissing('user');
    }

    public function show(Survey $survey)
    {
        return $survey;
    }

    public function showComplete(Survey $survey)
    {
        return $survey->loadMissing(
            [
                'openQuestions',
                'multiplechoiceQuestions',
                'multiplechoiceQuestions.multiplechoiceItems'
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                       => ['required', 'integer', 'exists:users,id'],
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys,name'],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
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

    public function storeComplete(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                       => ['required', 'integer', 'exists:users,id'],
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys,name'],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
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

        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->open_questions as $open_question) {
            $newQuestion = new OpenQuestion();
            $newQuestion->id = 0;
            $newQuestion->survey_id = $survey->id;
            $newQuestion->title = $open_question['title'];
            $newQuestion->description = $open_question['description'];
            $newQuestion->rows = $open_question['rows'];
            $newQuestion->question_order = $open_question['question_order'];
            $newQuestion->save();
        }

        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->multiplechoice_questions as $multi_question) {
            error_log('Hier werkt het niet meer?');
            $newQuestion = new MultiplechoiceQuestion();
            $newQuestion->id = 0;
            $newQuestion->survey_id = $survey->id;
            $newQuestion->title = $multi_question['title'];
            $newQuestion->description = $multi_question['description'];
            $newQuestion->multiple_answers = $multi_question['multiple_answers'];
            $newQuestion->question_order = $multi_question['question_order'];
            $newQuestion->save();

            foreach ($multi_question['multiplechoice_items'] as $multi_item) {
                $newItem = new MultiplechoiceItem();
                $newItem->id = 0;
                $newItem->multiplechoice_question_id = $newQuestion->id;
                $newItem->title = $multi_item['title'];
                $newItem->save();
            }
        }
        return response()->json($survey, 201);
    }

    public function update(Request $request, Survey $survey)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                       => ['required', 'integer', 'exists:users,id'],
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys,name,' .$survey->name],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
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

    public function updateComplete(Request $request, Survey $survey)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id'                       => ['required', 'integer', 'exists:users,id'],
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys,name,' .$survey->name],
                'description'                   => ['required', 'min:6', 'max:255', 'string'],
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

        $requestOpenQuestions = [];
        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->open_questions as $open_question) {
            if(!$open_question['id'] || $open_question['id'] == 0) {
                $newQuestion = new OpenQuestion();

                $newQuestion->id = 0;
                $newQuestion->survey_id = $survey->id;
                $newQuestion->title = $open_question['title'];
                $newQuestion->description = $open_question['description'];
                $newQuestion->rows = $open_question['rows'];
                $newQuestion->question_order = $open_question['question_order'];
                $newQuestion->save();

                array_push($requestOpenQuestions, $newQuestion->id);
            } else {
                $updateQuestion = OpenQuestion::where('id', $open_question['id'])->first();
                $updateQuestion->title = $open_question['title'];
                $updateQuestion->description = $open_question['description'];
                $updateQuestion->rows = $open_question['rows'];
                $updateQuestion->question_order = $open_question['question_order'];
                $updateQuestion->update();
                array_push($requestOpenQuestions, $updateQuestion->id);
            }
        }

        $currentOpenQuestions = OpenQuestion::where('survey_id', $survey->id)->get();
        foreach ($currentOpenQuestions as $currentOpenQuestion) {
            if(!in_array($currentOpenQuestion->id, $requestOpenQuestions)) {
                //If the current question is not in the array, delete it
                $currentOpenQuestion->delete();
            }
        }

        $requestMultiQuestions = [];
        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->multiplechoice_questions as $multi_question) {
            if(!$multi_question['id'] || $multi_question['id'] == 0) {
                $newQuestion = new MultiplechoiceQuestion();
                $newQuestion->id = 0;
                $newQuestion->survey_id = $survey->id;
                $newQuestion->title = $multi_question['title'];
                $newQuestion->description = $multi_question['description'];
                $newQuestion->multiple_answers = $multi_question['multiple_answers'];
                $newQuestion->question_order = $multi_question['question_order'];
                $newQuestion->save();

                foreach ($multi_question['multiplechoice_items'] as $multi_item) {
                    $newItem = new MultiplechoiceItem();
                    $newItem->id = 0;
                    $newItem->multiplechoice_question_id = $newQuestion->id;
                    $newItem->title = $multi_item['title'];
                    $newItem->save();
                }

                array_push($requestMultiQuestions, $newQuestion->id);
            } else {
                $updateQuestion = MultiplechoiceQuestion::where('id', $multi_question['id'])->first();
                $updateQuestion->title = $multi_question['title'];
                $updateQuestion->description = $multi_question['description'];
                $updateQuestion->multiple_answers = $multi_question['multiple_answers'];
                $updateQuestion->question_order = $multi_question['question_order'];
                $updateQuestion->update();

                array_push($requestOpenQuestions, $updateQuestion->id);

                $requestMultiItems = [];
                foreach ($multi_question['multiplechoice_items'] as $multi_item) {
                    if(!$multi_question['id'] || $multi_question['id'] == 0) {
                        $newItem = new MultiplechoiceItem();
                        $newItem->id = 0;
                        $newItem->multiplechoice_question_id = $newQuestion->id;
                        $newItem->title = $multi_item['title'];
                        $newItem->save();

                        array_push($requestMultiItems, $newItem->id);
                    } else {
                        $updateItem = MultiplechoiceItem::where('id', $multi_item['id'])->first();
                        $updateItem->title = $multi_item['title'];
                        $updateItem->update();

                        array_push($requestMultiItems, $updateItem->id);
                    }
                }

                $currentMultiItems = MultiplechoiceItem::where('multiplechoice_question_id', $updateQuestion->id)->get();
                foreach ($currentMultiItems as $currentMultiItem) {
                    if(!in_array($currentMultiItem->id, $requestMultiItems)) {
                        //If the current item is not in the array, delete it
                        $currentMultiItem->delete();
                    }
                }
            }
        }

        $currentMultiQuestions = MultiplechoiceQuestion::where('survey_id', $survey->id)->get();
        foreach ($currentMultiQuestions as $currentMultiQuestion) {
            if(!in_array($currentMultiQuestion->id, $requestMultiQuestions)) {
                //If the current item is not in the array, delete it
                $currentMultiQuestion->loadMissing('multiplechoiceItems');
                foreach ($currentMultiQuestion->multiplechoice_items as $multiItem) {
                    $multiItem->delete();
                }
                $currentMultiItem->delete();
            }
        }

        $survey->update($request->all());

        return response()->json($survey, 201);
    }

    public function delete(Survey $survey)
    {
        $openQuestions = OpenQuestion::where('survey_id', $survey->id)->get();
        foreach ($openQuestions as $openQuestion) {
            $openQuestion->delete();
        }

        $multiQuestions = MultiplechoiceQuestion::where('survey_id', $survey->id)->get();
        foreach ($multiQuestions as $multiQuestion) {
            $multiItems = MultiplechoiceItem::where('multiplechoice_question_id', $multiQuestion->id)->get();
            foreach ($multiItems as $multiItem) {
                $multiItem->delete();
            }
            $multiQuestion->delete();
        }

        $survey->delete();

        return response()->json(null, 204);
    }
}
