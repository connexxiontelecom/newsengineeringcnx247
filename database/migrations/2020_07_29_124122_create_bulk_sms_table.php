<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_sms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('sender_id')->nullable();
            $table->tinyInteger('status')->default(0)->nullable(); //1=sent, 0=pending
            $table->tinyInteger('delivered')->default(0)->nullable(); //1=sent, 0=pending
            $table->string('mobile_no')->nullable();
            $table->string('message')->nullable();
            $table->time('time_sent')->nullable();
            $table->time('time_received')->nullable();
            $table->time('batch_id')->nullable();
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
        Schema::dropIfExists('bulk_sms');
    }
}
