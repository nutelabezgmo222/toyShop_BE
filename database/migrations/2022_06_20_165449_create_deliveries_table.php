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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('price');
            $table->string('description', 45);
            $table->BigInteger('PostalService_id')->unsigned();
        });

        Schema::table('deliveries', function($table) {
            $table->foreign('PostalService_id')->references('id')->on('postal_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
