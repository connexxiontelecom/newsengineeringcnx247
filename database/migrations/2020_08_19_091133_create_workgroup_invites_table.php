<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkgroupInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroup_invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workgroup_id');
            $table->unsignedBigInteger('invited_by');
            $table->unsignedBigInteger('invite');
            $table->unsignedBigInteger('tenant_id');
            $table->text('message');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('workgroup_invites');
    }
}
