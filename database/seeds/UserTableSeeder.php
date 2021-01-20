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
        //Seeder for test users
        DB::table('user')->insert(
            [
                [
                    'email' => 'user@test.be',
                    'first_name' => 'Arno',
                    'last_name' => 'Arkens',
                    'password' => Hash::make('testtest'),
                    'role_id' => 1
                ],
                [
                    'email' => 'staff@test.be',
                    'first_name' => 'Barry',
                    'last_name' => 'Bostols',
                    'password' => Hash::make('testtest'),
                    'role_id' => 2
                ],
                [
                    'email' => 'admin@test.be',
                    'first_name' => 'Connie',
                    'last_name' => 'Cannaerts',
                    'password' => Hash::make('testtest'),
                    'role_id' => 3
                ],
            ]);
    }
}
