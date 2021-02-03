<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: information
        DB::table('information')->insert(
            [
                [
                    'user_id' => 1,
                    'title' => 'Corona info',
                    'body' => 'Lorem ipsum',
                    'created_at' => Carbon::parse('2021-02-02')
                ],
                [
                    'user_id' => 2,
                    'title' => 'Start aanleg fietsweg',
                    'body' => 'Lorem ipsum',
                    'created_at' => Carbon::parse('2021-02-02')
                ],
                [
                    'user_id' => 3,
                    'title' => 'Werken in het centrum',
                    'body' => 'Lorem ipsum',
                    'created_at' => Carbon::parse('2021-02-02')
                ],
            ]);
    }
}
