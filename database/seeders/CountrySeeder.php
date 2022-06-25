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
        $countries = ['Ukraine', 'USA', 'France', 'Germany', 'Italy'];

        foreach($countries as $country) {
            DB::table('countries')->insert([
                'id' => NULL,
                'title' => $country
            ]);
        }
    }
}