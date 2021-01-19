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
        //Seeder for test users
        DB::table('roles')->insert(
            [
                [
                    'name' => 'Gebruiker'
                ],
                [
                    'name' => 'Werknemer'
                ],
                [
                    'name' => 'Administrator'
                ],
            ]);
    }
}
