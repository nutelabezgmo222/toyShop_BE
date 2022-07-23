<?php

namespace Database\Seeders;

use App\Models\Toy;
use App\Models\SubCategory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToySubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toys = Toy::all();
        $subCategories = SubCategory::all();
        $categoriesLength = $subCategories->count();

        foreach($toys as $toy) {
            $firstCategory = $subCategories[rand(0, $categoriesLength - 1)]->id;
            $secondCategory = $subCategories[rand(0, $categoriesLength - 1)]->id;

            if($secondCategory != $firstCategory) {
                DB::table('toy_subcategories')->insert([
                    'Toy_id' => $toy->id,
                    'Subcategory_id' => $secondCategory,
                ]);
            }

            DB::table('toy_subcategories')->insert([
                'Toy_id' => $toy->id,
                'Subcategory_id' => $firstCategory,
            ]);
        }
    }
}
