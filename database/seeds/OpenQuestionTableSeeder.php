<?php

use Illuminate\Database\Seeder;

class OpenQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: open questions
        DB::table('open_questions')->insert(
            [
                [
                    'survey_id' => 1,
                    'title' => 'Waar in Herentals parkeert u uw auto?',
                    'description' => 'U hoeft geen straatnamen te geven (maar mag wel), een algemene locatie is duidelijk',
                    'rows' => 1
                ],
                [
                    'survey_id' => 2,
                    'title' => 'Hoe voelt u zich bij de huidige maatregelen',
                    'description' => '',
                    'rows' => 5
                ],
                [
                    'survey_id' => 3,
                    'title' => 'Welke events zou u graag meer zien binnen Herentals',
                    'description' => 'bijvoorbeeld: festivals, activiteiten, beurzen, ...',
                    'rows' => 10
                ],
            ]);
    }
}
