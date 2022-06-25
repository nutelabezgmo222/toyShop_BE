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
        if(env('DB_CONNECTION') === 'mysql') {
            $tables = DB::select('SHOW TABLES');
            $tableProperty = 'Tables_in_'.env('DB_DATABASE');

            foreach($tables as $table) {
                DB::statement("ALTER TABLE ". $table->$tableProperty ." AUTO_INCREMENT = 1;"); // reset auto increment to 1
            }
        }
        
        //tables with references
        DB::table('toys')->delete();
        DB::table('brands')->delete();
        DB::table('sub_categories')->delete();
        DB::table('categories')->delete();

        DB::table('countries')->delete();
        DB::table('age_limits')->delete();
        DB::table('gender_categories')->delete();
        DB::table('users')->delete();

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
