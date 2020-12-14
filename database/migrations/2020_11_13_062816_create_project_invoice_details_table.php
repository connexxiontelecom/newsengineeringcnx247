<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('project_id');
            $table->string('description')->nullable();
            $table->string('ref_no')->nullable();
            $table->double('amount')->nullable();
            $table->unsignedBigInteger('glcode');
            $table->string('slug');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=not approved, 1=approved, 2=declined');
            $table->tinyInteger('posted')->default(0)->comment('0=not posted, 1=posted');
            $table->dateTime('date_posted')->nullable();
            $table->unsignedBigInteger('posted_by')->nullable();
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
        Schema::dropIfExists('project_invoice_details');
    }
}
