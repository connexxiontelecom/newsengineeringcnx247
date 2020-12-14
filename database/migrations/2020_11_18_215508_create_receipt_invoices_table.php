<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_invoices', function (Blueprint $table) {
						$table->id();
						$table->unsignedBigInteger('tenant_id');
						$table->unsignedBigInteger('invoice_id');
						$table->unsignedBigInteger('receipt_id');
						$table->tinyInteger('posted')->default(0)->comment('0=not posted, 1=posted');
						$table->tinyInteger('trash')->default(0)->comment('0=not trashed, 1=trashed');
						$table->double('amount')->default(0);
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
        Schema::dropIfExists('receipt_invoices');
    }
}
