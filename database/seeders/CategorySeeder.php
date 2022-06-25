<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Guns' => ['blaster', 'water gun', 'crossbow'],
            'Сonstructors' => ['wood constructors', 'constructors for babies', 'magnetic constructors'],
            'Dolls' => ['doll accessories', 'dolls', 'doll mannequins'],
            'First toys' => ['Bath toys', 'sandbox toys', 'cubes']
        ];
        
        foreach($categories as $category => $subCategories) {
            DB::table('categories')->insert([
                'id' => NULL,
                'title' => $category
            ]);

            $lastInsertedId = DB::getPdo()->lastInsertId();

            foreach($subCategories as $subCategory) {
                DB::table('sub_categories')->insert([
                    'id' => NULL,
                    'title' => $subCategory,
                    'Category_id' => $lastInsertedId
                ]);
            }
        }
        
    }
}
