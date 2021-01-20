<?php

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
                    'title' => 'Arno Arkens werkt bij de groendienst',
                    'body' => 'Heeft toegang tot de info over vuilbakken'
                ],
                [
                    'user_id' => 2,
                    'title' => 'Barry Bostols is een participant',
                    'body' => 'Heeft toegang tot participaties?'
                ],
                [
                    'user_id' => 3,
                    'title' => 'Connie Cannaerts werkt bij communicatie',
                    'body' => 'Heeft toegang tot het aanmaken en bewerken van enquetes'
                ],
                [
                    'user_id' => 4,
                    'title' => 'Dirk Dockers werkt als externe',
                    'body' => 'Heeft toegang tot verschillende functies voor onderhoud'
                ],
                [
                    'user_id' => 5,
                    'title' => 'Erica Erentals is admin',
                    'body' => 'Heeft toegang tot alles'
                ],
            ]);
    }
}
