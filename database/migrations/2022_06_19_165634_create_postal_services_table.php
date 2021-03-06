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
        Schema::create('postal_services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->tinyInteger('Postal_id')->unsigned();
        });

        Schema::table('postal_services', function($table) {
            $table->foreign('Postal_id')->references('id')->on('postals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postal_services');
    }
};
