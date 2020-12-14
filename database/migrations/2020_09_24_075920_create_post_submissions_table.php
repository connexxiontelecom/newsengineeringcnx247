<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('submitted_by');
            $table->unsignedBigInteger('owner');
            $table->unsignedBigInteger('tenant_id');
            $table->string('post_type');
            $table->dateTime('date_submitted');
            $table->text('note')->nullable();
            $table->string('status')->default('in-progress');//in-progress
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
        Schema::dropIfExists('post_submissions');
    }
}
