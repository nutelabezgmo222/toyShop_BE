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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('surname', 45);
            $table->string('email', 45)->unique();
            $table->integer('phone_number');
            $table->string('password', 45);
            $table->date('registration_date');
            $table->dateTime('last_log_time');
            $table->tinyInteger('is_admin');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
