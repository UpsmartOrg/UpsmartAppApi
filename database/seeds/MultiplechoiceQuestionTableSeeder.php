<?php

use Illuminate\Database\Seeder;

class MultiplechoiceQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: multiplechoice questions
        DB::table('multiplechoice_questions')->insert(
            [
                [
                    'survey_id' => 1,
                    'question_order' => 1,
                    'title' => 'Hebt u vaak problemen om parkeerplaats te vinden',
                    'description' => 'Wat vragen over de parkeerplaats binnen Herentals',
                    'multiple_answers' => false
                ],
                [
                    'survey_id' => 2,
                    'question_order' => 2,
                    'title' => 'Met hoeveel verschillende mensen komt u in contact',
                    'description' => 'Enquête is anoniem, deze info is niet incriminerend',
                    'multiple_answers' => true
                ],
                [
                    'survey_id' => 3,
                    'question_order' => 1,
                    'title' => 'Hoe goed scoort Herentals met de huidige aanbieding van activiteiten',
                    'description' => '',
                    'multiple_answers' => false
                ],
            ]);
    }
}
