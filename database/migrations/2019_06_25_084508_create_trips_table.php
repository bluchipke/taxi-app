<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('trip_id');
            $table->string('client_name', 180);
            $table->integer('organization_id');
            $table->string('start_point', 180);
            $table->string('end_point', 180)->nullable(true);
            $table->integer('vehicle_id');
            $table->integer('mileage_out')->nullable(true);
            $table->integer('mileage_in')->nullable(true);
            $table->integer('distance')->nullable(true);
            $table->integer('schedule_id')->nullable(true);
            $table->time('time_out')->nullable(true);
            $table->time('time_in')->nullable(true);
            $table->decimal('total_time', 4, 2)->nullable('0');
            $table->date('created_date')->nullable(true);
            $table->softDeletes();
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
        Schema::dropIfExists('trips');
    }
}
