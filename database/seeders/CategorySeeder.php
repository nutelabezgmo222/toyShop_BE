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

        $id = 1;
        $subId = 1;

        foreach($categories as $category => $subCategories) {
            DB::table('categories')->insert([
                'id' => $id,
                'title' => $category
            ]);
            
            foreach($subCategories as $subCategory) {
                DB::table('sub_categories')->insert([
                    'id' => $subId,
                    'title' => $subCategory,
                    'Category_id' => $id
                ]);

                $subId = $subId + 1;
            }

            $id = $id + 1;
        }

        DB::statement('ALTER SEQUENCE sub_categories_id_seq RESTART WITH ' .$id);
    }
}
