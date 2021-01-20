<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: users
        DB::table('users')->insert(
            [
                [
                    'email' => 'aa@test.be',
                    'first_name' => 'Arno',
                    'last_name' => 'Arkens',
                    'password' => Hash::make('testtest'),
                    'role_id' => 1
                ],
                [
                    'email' => 'bb@test.be',
                    'first_name' => 'Barry',
                    'last_name' => 'Bostols',
                    'password' => Hash::make('testtest'),
                    'role_id' => 2
                ],
                [
                    'email' => 'cc@test.be',
                    'first_name' => 'Connie',
                    'last_name' => 'Cannaerts',
                    'password' => Hash::make('testtest'),
                    'role_id' => 3
                ],
                [
                    'email' => 'dd@test.be',
                    'first_name' => 'Dirk',
                    'last_name' => 'Dockers',
                    'password' => Hash::make('testtest'),
                    'role_id' => 4
                ],
                [
                    'email' => 'ee@test.be',
                    'first_name' => 'Erica',
                    'last_name' => 'Erentals',
                    'password' => Hash::make('testtest'),
                    'role_id' => 5
                ],
            ]);
    }
}
