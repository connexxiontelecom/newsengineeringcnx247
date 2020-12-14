<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectInvoiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_invoice_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('project_id');
            $table->string('invoice_no');
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=approved');
            $table->dateTime('invoice_date');
            $table->double('invoice_amount');
            $table->double('vat_amount')->nullable();
            $table->double('vat_charge')->nullable();
            $table->unsignedBigInteger('invoice_to')->nullable();
            $table->double('paid_amount')->default(0)->comment('0=unpaid, 1=paid');
            $table->double('discount_fee')->default(0)->nullable();
            $table->double('discount_rate')->default(0)->nullable();
            $table->string('instruction')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=not approved, 1=approved, 2=declined');
            $table->tinyInteger('posted')->default(0)->comment('0=not posted, 1=posted');
            $table->dateTime('date_posted')->nullable();
            $table->unsignedBigInteger('posted_by')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('project_invoice_masters');
    }
}
