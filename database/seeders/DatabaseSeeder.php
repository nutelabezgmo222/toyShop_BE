<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //tables with references
        DB::table('toy_subcategories')->delete();
        DB::table('toys')->delete();
        DB::table('brands')->delete();
        DB::table('sub_categories')->delete();
        DB::table('categories')->delete();
        DB::table('order_statuses')->delete();
        DB::table('cities')->delete();
        DB::table('postal_services')->delete();
        DB::table('postals')->delete();

        DB::table('countries')->delete();
        DB::table('age_limits')->delete();
        DB::table('gender_categories')->delete();
        DB::table('users')->delete();

        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            OrderStatusSeeder::class,
            PostalSeeder::class,
            PostalServiceSeeder::class,
            AgeLimitSeeder::class,
            GenderCategorySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,

            BrandSeeder::class,
            ToySeeder::class,
            ToySubcategorySeeder::class
        ]);
    }
}
