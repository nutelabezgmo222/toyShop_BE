<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $cities = ['Kharkiv', 'Kyiv', 'Lviv', 'Vinitsya', 'Djitomir', 'Mukachevo', 'Beregovo', 'Uzhorod'];

        foreach($cities as $city) {
            DB::table('cities')->insert([
                'id' => $id,
                'title' => $city,
                'Country_id' => 1
            ]);

            $id = $id + 1;
        }

        DB::statement('ALTER SEQUENCE countries_id_seq RESTART WITH ' .$id + 1);
    }
}
