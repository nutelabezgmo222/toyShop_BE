<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $id = 1;
        $countries = ['Ukraine', 'USA', 'France', 'Germany', 'Italy'];

        foreach($countries as $country) {
            DB::table('countries')->insert([
                'id' => $id,
                'title' => $country
            ]);

            $id = $id + 1;
        }

        DB::statement('ALTER SEQUENCE countries_id_seq RESTART WITH ' .$id);
    }
}
