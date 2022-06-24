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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->dateTime('creation_date');
            $table->dateTime('completition_date');
            $table->BigInteger('Delivery_id')->unsigned();
            $table->BigInteger('User_id')->unsigned();
        });

        Schema::table('orders', function($table) {
            $table->foreign('Delivery_id')->references('id')->on('deliveries');
            $table->foreign('User_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
