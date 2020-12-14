<?php
/*
*Author: Connexxion Group > CSwitch
*Developer: Gbudu Joseph
*Start Date: 26th May, 2020
*Launch Date:
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #This table is no longer in use. Role Table was used instead
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->string('name');
            $table->string('duration');
            $table->double('price');
            $table->text('description')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('plans');
    }
}
