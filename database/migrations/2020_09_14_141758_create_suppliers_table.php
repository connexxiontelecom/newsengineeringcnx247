<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('industry');
            $table->unsignedBigInteger('glcode');
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('company_address');
            $table->integer('team_size')->nullable();
            $table->string('first_name');
            $table->string('email_address');
            $table->string('position')->nullable();
            $table->string('mobile_no');
            $table->string('password')->nullable();
            $table->string('logo')->default('logo.png')->nullable();
            $table->string('website')->default('https://www.cnx247.com')->nullable();
            $table->string('tagline')->default('Thrive with us...')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
