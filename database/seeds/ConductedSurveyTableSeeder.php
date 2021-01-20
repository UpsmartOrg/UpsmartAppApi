<?php

use Illuminate\Database\Seeder;

class ConductedSurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: conducted surveys
        DB::table('conducted_surveys')->insert(
            [
                [
                    'survey_id' => 1,
                    'conducted_on' => DateTime::createFromFormat('d/m/Y H:i', '05/01/2021 15:22')
                ],
                [
                    'survey_id' => 2,
                    'conducted_on' => DateTime::createFromFormat('d/m/Y H:i', '07/01/2021 16:33')
                ],
                [
                    'survey_id' => 3,
                    'conducted_on' => DateTime::createFromFormat('d/m/Y H:i', '09/01/2021 17:44')
                ],
            ]);
    }
}
