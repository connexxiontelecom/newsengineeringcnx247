<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('ref_no');
            $table->dateTime('issue_date');
            $table->double('amount');
            $table->tinyInteger('payment_type')->default(1);
            $table->string('slug')->nullable();
            $table->string('memo')->nullable();
            $table->timestamps();
            $table->tinyInteger('posted')->default(0);
            $table->tinyInteger('trash')->default(0);
            $table->unsignedBigInteger('bank')->nullable();
            $table->dateTime('date_posted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
