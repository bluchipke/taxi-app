<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('driver_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('driver_email', 100);
            $table->string('id_card', 100);
            $table->string('kra_pin', 100)->nullable(true);
            $table->string('nssf', 100)->nullable(true);
            $table->string('nhif', 100)->nullable(true);
            $table->string('employee_code', 100)->nullable(true);
            $table->string('department', 100)->nullable(true);
            $table->string('phone_number', 100)->nullable(true);
            $table->string('gender', 50)->nullable(true);
            $table->string('marital_status', 50)->nullable(true);
            $table->year('date_of_birth')->nullable(true);
            $table->string('county', 100)->nullable(true);
            $table->string('estate', 100)->nullable(true);
            $table->string('box_address', 100)->nullable(true);
            $table->string('postal_code', 100)->nullable(true);
            $table->string('town', 100)->nullable(true);
            $table->string('job_title', 100)->nullable(true);
            $table->string('date_started', 100)->nullable(true);
            $table->smallInteger('employment_type')->nullable(true);
            $table->smallInteger('employment_status')->nullable(true);
            $table->string('next_of_kin', 100)->nullable(true);
            $table->string('next_of_kin_email', 100)->nullable(true);
            $table->string('next_of_kin_phone', 100)->nullable(true);
            $table->string('relationship', 100)->nullable(true);
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
        Schema::dropIfExists('drivers');
    }
}
