<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('client_id');
            $table->string('client_desc', 120);
            $table->string('client_phone', 120)->nullable(true);
            $table->string('client_email', 120)->nullable(true);
            $table->string('client_status', 120)->nullable(true);
            $table->text('client_address')->nullable(true);
            $table->string('company_size', 120)->nullable(true);
            $table->text('client_notes')->nullable(true);
            $table->string('account_number', 180)->nullable(true);
            $table->string('industry', 120);
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
        Schema::dropIfExists('organizations');
    }
}
