<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->dateTime('date_inputed')->nullable();
            $table->double('amount');
            $table->string('ref_no')->nullable();
            $table->string('memo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('date_now')->nullable();
            $table->tinyInteger('posted')->default(0);
            $table->dateTime('posted_date')->nullable();
            $table->tinyInteger('trash')->default(0);
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('pay_masters');
    }
}
