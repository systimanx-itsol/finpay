<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item_amounts', function (Blueprint $table) {
            $table->uuid('id', 36);
            $table->uuid('invoice_id', 36);
			$table->foreign('invoice_id')->references('invoice_id')->on('invoices');
            $table->uuid('item_id', 36); 
			$table->foreign('item_id')->references('item_id')->on('invoice_items');
			$table->float('subtotal_not_dis', 10,2)->nullable();
            $table->string('sub_total', 255)->nullable();
            $table->float('tax', 10,2)->nullable();
            $table->float('discount_amount', 10,2)->nullable();
            $table->float('total_amount', 10,2)->nullable();
			$table->softdeletes();
            $table->timestamps();
            //$table->foreign('item_id')->references('item_id')->on('quotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_item_amounts');
    }
}
