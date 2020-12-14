<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('currency_id');
            $table->string('duration');
            $table->double('price');
            $table->string('description')->nullable();
            $table->integer('emails')->nullable();
            $table->integer('calls')->nullable();
            $table->integer('sms')->nullable();
            $table->integer('team_size')->nullable();
            $table->integer('storage_size')->nullable();
            $table->integer('stream')->nullable();
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
        Schema::dropIfExists('plan_features');
    }
}
