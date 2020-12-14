<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('registered_by');
            $table->integer('type_of_identification')->nullable();
            $table->string('first_name');
            $table->string('surname')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('gender')->default(0)->nullable();
            $table->string('user_id')->nullable();
            $table->string('attachment')->nullable();
            $table->string('url')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('location')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('role')->default(1)->nullable();//0=customer; 1=Driver
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
        Schema::dropIfExists('logistics_users');
    }
}
