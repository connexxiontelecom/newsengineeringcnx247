<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('glcode');
            $table->unsignedBigInteger('entry_by');
            $table->string('narration')->nullable();
            $table->string('name')->nullable();
            $table->double('dr_amount')->default(0);
            $table->double('cr_amount')->default(0);
            $table->string('ref_no')->nullable();
            $table->dateTime('jv_date')->nullable();
            $table->dateTime('entry_date')->nullable();
            $table->tinyInteger('posted')->default(0)->nullable();
            $table->dateTime('posted_date')->nullable();
            $table->tinyInteger('trash')->default(0)->nullable();
            $table->unsignedBigInteger('tenant_id');
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
        Schema::dropIfExists('journal_vouchers');
    }
}
