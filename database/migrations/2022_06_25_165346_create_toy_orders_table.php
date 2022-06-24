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
        Schema::create('toy_orders', function (Blueprint $table) {
            $table->BigInteger('Toy_id')->unsigned();
            $table->BigInteger('Order_id')->unsigned();
            $table->integer('quantity');
            $table->float('price');

            $table->primary(array('Toy_id', 'Order_id'));
        });

        Schema::table('toy_orders', function($table) {
            $table->foreign('Toy_id')->references('id')->on('toys');
            $table->foreign('Order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toy_orders');
    }
};
