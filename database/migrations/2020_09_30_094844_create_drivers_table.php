<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('registered_by');
            $table->integer('type_of_identification')->nullable();
            $table->string('first_name');
            $table->string('surname');
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('gender')->default(0)->nullable();
            $table->string('driver_id')->nullable();
            $table->string('attachment')->nullable();
            $table->string('url')->nullable();
            $table->string('avatar')->nullable();
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
