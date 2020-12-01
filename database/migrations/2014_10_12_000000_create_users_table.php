<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        In english only email and password attributes

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('vardas');
            $table->string('pavarde');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel_nr');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('orders_id')->nullable();
            $table->string('role_id')->nullable();

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
}
