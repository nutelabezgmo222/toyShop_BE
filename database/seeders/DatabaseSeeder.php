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
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      //no reference tables
      DB::table('countries')->truncate();
      DB::table('age_limits')->truncate();
      DB::table('gender_categories')->truncate();
      DB::table('users')->truncate();
      DB::table('categories')->truncate();
      //tables with references
      DB::table('sub_categories')->truncate();
      DB::table('brands')->truncate();
      DB::table('toys')->truncate();

      $this->call([
          CountrySeeder::class,
          AgeLimitSeeder::class,
          GenderCategorySeeder::class,
          UserSeeder::class,
          CategorySeeder::class,

          BrandSeeder::class,
          ToySeeder::class
      ]);
    }
}
