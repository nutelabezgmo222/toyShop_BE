<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 0;
        $countries = Country::all();
        $countriesLength = $countries->count();

        $brands = [
            ['Puma', 'very good brand 1'],
            ['Nike', 'very good brand 2'],
            ['Lego', 'very good brand 3'],
            ['Loli', 'very good brand 4'],
            ['Pusheen', 'very good brand 5'],
        ];

        foreach($brands as $brand) {
            DB::table('brands')->insert([
                'id' => $id,
                'title' => $brand[0],
                'description' => $brand[1],
                'Country_id' => $countries[rand(0, $countriesLength - 1)]->id
            ]);
            $id = $id + 1;
        }
    }
}
