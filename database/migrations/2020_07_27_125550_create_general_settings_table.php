<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('date_format_id');
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('currency_id');
            $table->text('company_policy')->nullable();
            $table->string('downloadable_policy')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->string('downloadable_privacy')->nullable();
            $table->string('default_email')->nullable();
            $table->string('email_signature')->nullable();
            $table->string('default_phone')->nullable();
            $table->string('default_mobile')->nullable();
            $table->string('street_1')->nullable();
            $table->string('street_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_zone')->nullable();
            //$table->string('postal')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('tagline')->nullable();
            $table->string('company_prefix')->nullable(); //example CNX
            $table->text('description')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
