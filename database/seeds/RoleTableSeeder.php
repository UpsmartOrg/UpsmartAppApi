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
        //Seeder for test roles
        DB::table('role')->insert(
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
