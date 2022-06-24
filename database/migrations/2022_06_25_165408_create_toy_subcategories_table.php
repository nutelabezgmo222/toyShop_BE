<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toy_subcategories', function (Blueprint $table) {
            $table->BigInteger('Toy_id')->unsigned();
            $table->tinyInteger('Subcategory_id')->unsigned();

            $table->primary(array('Toy_id', 'Subcategory_id'));
        });

        Schema::table('toy_subcategories', function($table) {
            $table->foreign('Toy_id')->references('id')->on('toys');
            $table->foreign('Subcategory_id')->references('id')->on('sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toy_subcategories');
    }
};
