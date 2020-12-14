<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('uploaded_by');
            $table->string('filename')->nullable();
            $table->string('name')->nullable();
            $table->double('size')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('file_models');
    }
}
