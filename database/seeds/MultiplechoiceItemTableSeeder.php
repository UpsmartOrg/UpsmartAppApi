<?php

use Illuminate\Database\Seeder;

class MultiplechoiceItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: multiplechoice items
        DB::table('multiplechoice_items')->insert(
            [
                //Q 1
                [
                    'multiplechoice_question_id' => 1,
                    'title' => 'Ja'
                ],
                [
                    'multiplechoice_question_id' => 1,
                    'title' => 'Neen'
                ],
                //Q 2
                [
                    'multiplechoice_question_id' => 2,
                    'title' => '1 Persoon'
                ],
                [
                    'multiplechoice_question_id' => 2,
                    'title' => '2 Personen'
                ],
                [
                    'multiplechoice_question_id' => 2,
                    'title' => '3 Personen'
                ],
                [
                    'multiplechoice_question_id' => 2,
                    'title' => 'Meer dan 3 personen'
                ],
                //Q 3
                [
                    'multiplechoice_question_id' => 3,
                    'title' => 'middelmatig'
                ],
                [
                    'multiplechoice_question_id' => 3,
                    'title' => 'Goed'
                ],
                [
                    'multiplechoice_question_id' => 3,
                    'title' => 'Super goed'
                ],
            ]);
    }
}
