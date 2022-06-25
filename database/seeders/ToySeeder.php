<?php

namespace Database\Seeders;

use App\Models\GenderCategory;
use App\Models\AgeLimit;
use App\Models\Brand;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = GenderCategory::all();
        $ageLimits = AgeLimit::all();
        $brands = Brand::all();

        $toys = [
            ['Toy 1', 'description for toy 1', 123.45, ''],
            ['Toy 2', 'description for toy 2', 223.45, ''],
            ['Toy 3', 'description for toy 3', 50.23, ''],
            ['Toy 4', 'description for toy 4', 100, ''],
            ['Toy 5', 'description for toy 5', 548, ''],
        ];

        foreach($toys as $toy) {
            DB::table('toys')->insert([
                'id' => NULL,
                'title' => $toy[0],
                'description' => $toy[1],
                'price' => $toy[2],
                'image' => $toy[3],
                'GenderCategory_id' => $genders[rand(0, $genders->count() - 1)]->id,
                'AgeLimit_id' => $ageLimits[rand(0, $ageLimits->count() - 1)]->id,
                'Brand_id' => $brands[rand(0, $brands->count() - 1)]->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}