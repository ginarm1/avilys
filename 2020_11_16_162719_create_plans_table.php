<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->string('description');
            $table->integer('internet_data_mb');
            $table->double('cost_month');
            $table->double('old_cost_month');
            $table->integer('evaluation_time_month');
            $table->integer('sold_quantity');
            $table->string('description');
            $table->timestamps();
            $table->string('is_unlimited_internet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan');
    }
}
