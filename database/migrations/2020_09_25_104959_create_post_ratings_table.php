<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('rated_by');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');//person rated
            $table->double('rating')->default(0);
            $table->string('review')->nullable();
            $table->tinyInteger('use_for_appraisal')->default(0)->nullable(); //1=yes
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
        Schema::dropIfExists('post_ratings');
    }
}
