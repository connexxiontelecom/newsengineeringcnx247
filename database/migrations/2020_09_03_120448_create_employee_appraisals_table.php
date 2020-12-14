<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_appraisals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('employee');
            $table->unsignedBigInteger('supervisor');
            $table->string('appraisal_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->tinyInteger('appraisal_status')->default(0); //0=pending, 1=completed
            $table->tinyInteger('employee_status')->default(0); //0=pending, 1=completed
            $table->tinyInteger('supervisor_status')->default(0); //0=pending, 1=completed
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
        Schema::dropIfExists('employee_appraisals');
    }
}
