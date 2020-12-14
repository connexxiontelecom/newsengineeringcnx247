<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkgroupModeratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroup_moderators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workgroup_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('request_status')->default(0); //pending approval
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
        Schema::dropIfExists('workgroup_moderators');
    }
}
