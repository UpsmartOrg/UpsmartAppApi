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
                    'email' => 'ArnoA@herentals.be',
                    'username' => 'arno.a',
                    'first_name' => 'Arno',
                    'last_name' => 'Arkens',
                    'password' => Hash::make('testtest'),
                    'is_extern' => false,
                    'created_at' => DateTime::createFromFormat('d/m/Y H:i', '01/01/2020 15:00')
                ],
                [
                    'email' => 'BarryB@herentals.be',
                    'username' => 'barry.b',
                    'first_name' => 'Barry',
                    'last_name' => 'Bostols',
                    'password' => Hash::make('testtest'),
                    'is_extern' => false,
                    'created_at' => DateTime::createFromFormat('d/m/Y H:i', '01/01/2020 15:00')
                ],
                [
                    'email' => 'ConnieC@herentals.be',
                    'username' => 'connie.c',
                    'first_name' => 'Connie',
                    'last_name' => 'Cannaerts',
                    'password' => Hash::make('testtest'),
                    'is_extern' => false,
                    'created_at' => DateTime::createFromFormat('d/m/Y H:i', '01/01/2020 15:00')
                ],
                [
                    'email' => 'DirkD@herentals.be',
                    'username' => 'dirk.d',
                    'first_name' => 'Dirk',
                    'last_name' => 'Dockers',
                    'password' => Hash::make('testtest'),
                    'is_extern' => true,
                    'created_at' => DateTime::createFromFormat('d/m/Y H:i', '01/01/2020 15:00')
                ],
                [
                    'email' => 'EricaE@herentals.be',
                    'username' => 'erica.e',
                    'first_name' => 'Erica',
                    'last_name' => 'Erentals',
                    'password' => Hash::make('testtest'),
                    'is_extern' => false,
                    'created_at' => DateTime::createFromFormat('d/m/Y H:i', '01/01/2020 15:00')
                ],
            ]);
    }
}
