<?php

use Illuminate\Database\Seeder;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for testdata: zones
        DB::table('zones')->insert(
            [
                [
                    'name' => 'Centrum',
                    'description' => 'Van de Groenstraat tot de Molenstraat'
                ],
                [
                    'name' => 'Herentals-West',
                    'description' => 'Westen van het centrum'
                ],
                [
                    'name' => 'Herentals-Oost',
                    'description' => 'Oosten van het centrum'
                ],
                [
                    'name' => 'Industrie',
                    'description' => null
                ],
            ]);
    }
}
