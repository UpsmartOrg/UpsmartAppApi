<?php

namespace App\Http\Controllers;

use App\MultiplechoiceItem;
use App\MultiplechoiceQuestion;
use App\OpenQuestion;
use App\Rules\OpenQuestions;
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
                'user_id'                           => ['required', 'integer', 'exists:users,id'],
                'name'                              => ['required', 'min:6', 'max:255', 'string', 'unique:surveys,name'],
                'description'                       => ['max:255', 'string'],
                'start_date'                        => ['required', 'date', 'after_or_equal:now'],
                'end_date'                          => ['required', 'date', 'after_or_equal:start_date'],
            ],
            [
                'required'                          => ':attribute moet ingevuld zijn',
                'exists'                            => ':attribute bestaat niet binnen users',
                'min'                               => ':attribute moet minstens 6 karakters lang zijn',
                'max'                               => ':attribute mag maximum 255 karakters lang zijn',
                'string'                            => ':attribute moet een string zijn',
                'date'                              => ':attribute moet een geldige datum zijn',
                'integer'                           => ':attribute moet een integer zijn',
                'unique'                            => ':attribute is al in gebruik',
                'start_date.after_or_equal'         => ':attribute mag niet in het verleden vallen',
                'end_date.after_or_equal'           => ':attribute moet na de startdatum vallen',
            ]);
        //On validation fail
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $survey = Survey::create($request->all());

        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->open_questions as $open_question) {
            $open_question['survey_id'] = $survey->id;
            OpenQuestion::create($open_question);
        }

        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->multiplechoice_questions as $multi_question) {
            $multi_question['survey_id'] = $survey->id;
            $newQuestion = MultiplechoiceQuestion::create($multi_question);

            foreach ($multi_question['multiplechoice_items'] as $multi_item) {
                $multi_item['multiplechoice_question_id'] = $newQuestion->id;
                MultiplechoiceItem::create($multi_item);
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
                'name'                          => ['required', 'min:6', 'max:255', 'string', 'unique:surveys,name,' .$survey->id],
                'description'                   => ['max:255', 'string'],
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

        //Open questions update
        $updatedOpenQuestionID = [];
        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->open_questions as $open_question) {
            $open_question['survey_id'] = $survey->id;
            if(!array_key_exists('id', $open_question) || $open_question['id'] == 0) {
                $newQuestion = OpenQuestion::create($open_question);

                array_push($updatedOpenQuestionID, $newQuestion->id);
            } else {
                $updateQuestion = OpenQuestion::where('id', $open_question['id'])->first();
                $updateQuestion->update($open_question);

                array_push($updatedOpenQuestionID, $updateQuestion->id);
            }
        }

        //Delete open questsions not in updated list
        $oldOpenQuestions = OpenQuestion::where('survey_id', $survey->id)->get();
        foreach ($oldOpenQuestions as $oldOpenQuestion) {
            if(!in_array($oldOpenQuestion->id, $updatedOpenQuestionID)) {
                //If the old question is not in the updated question array, delete it
                $oldOpenQuestion->delete();
            }
        }

        //Multi questions update
        $updatedMultiQuestionID = [];
        //Loop through all open questsions in the request and add them as new openQuestion
        foreach ($request->multiplechoice_questions as $multi_question) {
            $multi_question['survey_id'] = $survey->id;
            if(!array_key_exists('id', $multi_question) || $multi_question['id'] == 0) {
                $newQuestion = MultiplechoiceQuestion::create($multi_question);

                foreach ($multi_question['multiplechoice_items'] as $multi_item) {
                    $multi_item['multiplechoice_question_id'] = $newQuestion->id;
                    MultiplechoiceItem::create($multi_item);
                }

                array_push($updatedMultiQuestionID, $newQuestion->id);
            } else {
                $updateQuestion = MultiplechoiceQuestion::where('id', $multi_question['id'])->first();
                $updateQuestion->update($multi_question);

                //Multi items update
                $updatedMultiItemID = [];
                foreach ($multi_question['multiplechoice_items'] as $multi_item) {
                    $multi_item['multiplechoice_question_id'] = $updateQuestion->id;
                    if(!$multi_question['id'] || $multi_question['id'] == 0) {
                        $newItem = MultiplechoiceItem::create($multi_item);

                        array_push($updatedMultiItemID, $newItem->id);
                    } else {
                        $updateItem = MultiplechoiceItem::where('id', $multi_item['id'])->first();

                        $updateItem->update($multi_item);

                        array_push($updatedMultiItemID, $updateItem->id);
                    }
                }

                //Delete multi items not in updated list
                $oldMultiItems = MultiplechoiceItem::where('multiplechoice_question_id', $updateQuestion->id)->get();
                foreach ($oldMultiItems as $oldMultiItem) {
                    if(!in_array($oldMultiItem->id, $updatedMultiItemID)) {
                        //If the current item is not in the array, delete it
                        $oldMultiItem->delete();
                    }
                }

                array_push($updatedMultiQuestionID, $updateQuestion->id);
            }
        }

        //Delete multi questsions not in updated list
        $oldMultiQuestsions = MultiplechoiceQuestion::where('survey_id', $survey->id)->get();
        foreach ($oldMultiQuestsions as $oldMultiQuestsion) {
            if(!in_array($oldMultiQuestsion->id, $updatedMultiQuestionID)) {
                //If the current item is not in the array, delete it
                $deleteMultiItems = MultiplechoiceItem::where('multiplechoice_question_id', $oldMultiQuestsion->id)->get();

                foreach ($deleteMultiItems as $deleteMultiItem) {
                    $deleteMultiItem->delete();
                }
                $oldMultiQuestsion->delete();
            }
        }

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
