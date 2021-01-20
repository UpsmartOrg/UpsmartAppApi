<?php

use Illuminate\Database\Seeder;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: answers
        DB::table('answers')->insert(
            [
                //C Survey 1
                [
                    'conducted_survey_id' => 1,
                    'open_question_id' => 1,
                    'open_question_answer' => "De parkeerplaats over het stadshuis",
                    'multiplechoice_item_id' => null,
                ],
                [
                    'conducted_survey_id' => 1,
                    'open_question_id' => null,
                    'open_question_answer' => null,
                    'multiplechoice_item_id' => 2,
                ],
                //C Survey 2
                [
                    'conducted_survey_id' => 2,
                    'open_question_id' => 2,
                    'open_question_answer' => "Ik zou graag hebben dat de horeca terug open gaat",
                    'multiplechoice_item_id' => null,
                ],
                [
                    'conducted_survey_id' => 2,
                    'open_question_id' => null,
                    'open_question_answer' => null,
                    'multiplechoice_item_id' => 5,
                ],
                //C Survey 3
                [
                    'conducted_survey_id' => 3,
                    'open_question_id' => 3,
                    'open_question_answer' => "Liefst wil een boekenbeur twee keer per jaar",
                    'multiplechoice_item_id' => null,
                ],
                [
                    'conducted_survey_id' => 3,
                    'open_question_id' => null,
                    'open_question_answer' => null,
                    'multiplechoice_item_id' => 8,
                ],
            ]);    }
}
