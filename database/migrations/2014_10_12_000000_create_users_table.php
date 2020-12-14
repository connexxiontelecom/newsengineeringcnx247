<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('surname')->nullable();
            $table->string('last_name')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->unsignedBigInteger('marital_status')->nullable();
            $table->string('username')->nullable();
            $table->tinyInteger('account_status')->default(1)->nullable();
            $table->unsignedBigInteger('active_theme')->default(1)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->dateTime('hire_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('confirm_date')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('job_role')->nullable();
            $table->string('position')->nullable();
            $table->string('role')->default('employee')->nullable();
            $table->string('avatar')->default('avatar.png')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('cover')->default('cover.png')->nullable();
            $table->string('url')->nullable();
            $table->string('transaction_password')->nullable();
            $table->string('verification_link')->nullable();
            $table->tinyInteger('verified')->default(0)->nullable(); //if yes = 1;
            $table->timestamp('last_seen')->nullable();;
            $table->tinyInteger('is_online')->default(0)->nullable(); //0=offline, 1=online
            $table->bigInteger('tenant_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
