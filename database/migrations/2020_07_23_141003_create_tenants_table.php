<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('industry_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('date_format_id');
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('currency_position_id')->nullable();
            $table->string('site_address');
            $table->string('website')->nullable();
            $table->string('company_name');
            $table->string('email');
            //$table->string('password');
            $table->string('use_case');
            $table->string('role');
            $table->string('phone');
            $table->double('team_size');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->tinyInteger('account_status')->default(1); //0=expired; 1=active
            $table->text('company_policy')->nullable();
            $table->string('downloadable_policy')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->string('downloadable_privacy')->nullable();
            $table->string('email_signature')->nullable();
            $table->string('street_1')->nullable();
            $table->string('street_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('active_sub_key')->nullable();
            //$table->string('postal')->nullable();
            $table->string('tagline')->nullable();
            $table->string('company_prefix')->nullable(); //example CNX
            $table->text('description')->nullable();
            $table->text('slug')->nullable();
            $table->text('invoice_terms')->nullable();
            $table->text('receipt_terms')->nullable();
            $table->time('opening_time')->default('08:00:00');
            $table->time('closing_time')->default('17:00:00');
            $table->integer('grace_period')->default(10);
            $table->string('timezone')->default('Africa/Lagos');
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
        Schema::dropIfExists('tenants');
    }
}
