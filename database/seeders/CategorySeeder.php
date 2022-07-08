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

        $id = 0;
        $subId = 0;

        foreach($categories as $category => $subCategories) {
            DB::table('categories')->insert([
                'id' => $id,
                'title' => $category
            ]);

            $lastInsertedId = DB::getPdo()->lastInsertId();
            
            foreach($subCategories as $subCategory) {
                DB::table('sub_categories')->insert([
                    'id' => $subId,
                    'title' => $subCategory,
                    'Category_id' => $lastInsertedId
                ]);

                $subId = $subId + 1;
            }

            $id = $id + 1;
        }
        
    }
}
