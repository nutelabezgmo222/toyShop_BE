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
        Schema::create('toys', function (Blueprint $table) {
            $table->id();

            $table->string('title', 100);
            $table->text('description');
            $table->float('price');
            $table->text('image');

            $table->tinyInteger('GenderCategory_id')->unsigned();
            $table->tinyInteger('AgeLimit_id')->unsigned();
            $table->tinyInteger('Brand_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('toys', function($table) {
            $table->foreign('GenderCategory_id')->references('id')->on('gender_categories');
            $table->foreign('AgeLimit_id')->references('id')->on('age_limits');
            $table->foreign('Brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toys');
    }
};
