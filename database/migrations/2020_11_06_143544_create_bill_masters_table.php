<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('bill_no');
            $table->string('ref_no')->nullable();
            $table->string('status')->default('unpaid');
            $table->dateTime('bill_date');
            $table->double('bill_amount');
            $table->string('attachment')->nullable();
            $table->double('vat_amount');
            $table->double('vat_charge');
            $table->unsignedBigInteger('billed_to');
            $table->double('paid_amount')->default(0);
						$table->tinyInteger('paid')->default(0)->comment('0=unpaid, 1=paid');
						$table->tinyInteger('trash')->nullable();
						$table->unsignedBigInteger('trashed_by')->nullable();
						$table->dateTime('trash_date')->nullable();
            $table->string('instruction')->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('bill_masters');
    }
}
