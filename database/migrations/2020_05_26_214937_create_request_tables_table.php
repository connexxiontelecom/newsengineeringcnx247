<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_tables', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('absence_type')->nullable();
            $table->string('request_type')->nullable();
            $table->double('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('attachment')->nullable();
            $table->string('priority')->nullable();
            $table->string('destination')->nullable();
            $table->string('expenses')->nullable();
            $table->string('request_status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('request_url')->nullable();
            $table->bigInteger('tenant_id')->nullable();
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
        Schema::dropIfExists('request_tables');
    }
}
