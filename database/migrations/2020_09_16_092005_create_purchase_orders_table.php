<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('purchase_order_no');
            $table->double('total')->default(0);
            $table->double('sub_total')->default(0);
            $table->string('instruction')->nullable();
            $table->string('status')->default('in-progress');
            $table->string('slug')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->unsignedBigInteger('delivered_by')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->dateTime('date_delivered')->nullable();
            $table->dateTime('date_confirmed')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
