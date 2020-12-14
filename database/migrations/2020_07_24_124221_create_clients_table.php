<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('assigned_to')->nullable(); //nullable
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('title')->nullable();
            $table->string('suffix')->nullable();
            $table->string('surname')->nullable();
            $table->string('other_names')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('website')->nullable();
            $table->string('note')->nullable();
            $table->string('avatar')->default('avatar.png')->nullable();
            #Address
            $table->string('street_1')->nullable();
            $table->string('street_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('glcode')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
