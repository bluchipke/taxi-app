<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('vehicle_id');
            $table->string('make', 100);
            $table->string('model', 100);
            $table->string('color', 100);
            $table->string('body', 100);
            $table->integer('mileage')->nullable(true);
            $table->string('gear_type', 100)->nullable(true);
            $table->string('chassis_number', 100)->nullable(true);
            $table->string('engine_number', 100)->nullable(true);
            $table->string('fuel_type', 100)->nullable(true);
            $table->integer('capacity')->nullable(true);
            $table->string('yom', 100)->nullable(true);
            $table->string('origin', 100)->nullable(true);
            $table->string('insurer', 100)->nullable(true);
            $table->string('policy_number', 100)->nullable(true);
            $table->string('condition', 100)->nullable(true);
            $table->string('status', 100)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
