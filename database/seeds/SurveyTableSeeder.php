<?php

use Carbon\Carbon;
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
                    'description' => 'Wat vragen over de parkeerplaats binnen Herentals',
                    'start_date' => Carbon::parse('2021-01-01'),
                    'end_date' => Carbon::parse('2021-07-30'),
                ],
                [
                    'user_id' => 3,
                    'name' => 'Covid enquête',
                    'description' => 'Wat vragen over u omgaat met COVID-19',
                    'start_date' => Carbon::parse('2021-01-01'),
                    'end_date' => Carbon::parse('2021-01-27'),
                ],
                [
                    'user_id' => 2,
                    'name' => 'Vragen omtrent activiteiten',
                    'description' => 'Welke activiteiten wil u deze zomer zien',
                    'start_date' => Carbon::parse('2021-01-01'),
                    'end_date' => Carbon::parse('2021-06-15'),
                ],
            ]);
    }
}
