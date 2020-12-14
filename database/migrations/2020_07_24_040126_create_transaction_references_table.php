<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('status')->nullable();
            $table->string('reference')->nullable();
            $table->double('amount')->nullable();
            $table->double('fees')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('channel')->nullable();
            $table->string('currency')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('bin')->nullable();
            $table->string('last4')->nullable();
            $table->string('exp_month')->nullable();
            $table->string('exp_year')->nullable();
            $table->string('card_type')->nullable();
            $table->string('bank')->nullable();
            $table->string('country_code')->nullable();
            $table->string('brand')->nullable();
            $table->string('account_name')->nullable();
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
        Schema::dropIfExists('transaction_references');
    }
}
