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
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->uuid('patient_id');
            $table->foreign('patient_id')->references('id')->on('clients');
            $table->string('relation_patient');
            $table->string('assistance');
            $table->string('category');
            $table->float('amount');
            $table->text('hospital');
            $table->text('hospital_address');
            $table->string('doctor_name');
            $table->text('diagnosis');
            $table->dateTime('date_time_requested');
            $table->dateTime('date_approved')->nullable();
            $table->text('remarks');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistances');
    }
};
