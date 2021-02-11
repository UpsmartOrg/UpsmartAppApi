<?php

use Illuminate\Database\Seeder;

class SurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: surveys
        DB::table('surveys')->insert(
            [
                [
                    'user_id' => 2,
                    'name' => 'Enquête over parkeerplaats',
                    'description' => 'Een aantal vragen over parkeren binnen Herentals.',
                    'quick_survey' => true,
                    'start_date' => DateTime::createFromFormat('d/m/Y H:i', '01/01/2021 00:00'),
                    'end_date' => DateTime::createFromFormat('d/m/Y H:i', '31/07/2021 00:00'),
                ],
                [
                    'user_id' => 3,
                    'name' => 'Covid enquête',
                    'description' => 'Een aantal vragen over hoe u omgaat met COVID-19.',
                    'quick_survey' => false,
                    'start_date' => DateTime::createFromFormat('d/m/Y H:i', '01/09/2020 00:00'),
                    'end_date' => DateTime::createFromFormat('d/m/Y H:i', '31/03/2021 00:00'),
                ],
                [
                    'user_id' => 2,
                    'name' => 'Vragen omtrent activiteiten',
                    'description' => 'Welke activiteiten wilt u deze zomer meer zien.',
                    'quick_survey' => false,
                    'start_date' => DateTime::createFromFormat('d/m/Y H:i', '01/05/2021 00:00'),
                    'end_date' => DateTime::createFromFormat('d/m/Y H:i', '31/08/2021 00:00'),
                ],
            ]);
    }
}
