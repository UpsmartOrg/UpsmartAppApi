<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: roles
        DB::table('roles')->insert(
            [
                [
                    'name' => 'Groendienst',
                    'description' => 'Werknemer van de groendienst'
                ],
                [
                    'name' => 'Participatie',
                    'description' => 'Deelenemer'
                ],
                [
                    'name' => 'Communicatie',
                    'description' => 'Werknemer van de Communicatie'
                ],
                [
                    'name' => 'Extern',
                    'description' => 'Externe werknemer'
                ],
                [
                    'name' => 'Administrator',
                    'description' => 'Administrator van het systeem'
                ],
            ]);
    }
}
