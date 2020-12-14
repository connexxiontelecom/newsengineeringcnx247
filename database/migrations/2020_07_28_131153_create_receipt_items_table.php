<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('description');
						$table->double('payment');
						$table->double('exchange_rate')->default(1);
						$table->unsignedBigInteger('currency_id')->default(1);
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
        Schema::dropIfExists('receipt_items');
    }
}
