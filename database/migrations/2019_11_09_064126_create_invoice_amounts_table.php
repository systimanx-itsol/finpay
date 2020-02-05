<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('invoice_amounts', function (Blueprint $table) {
            $table->uuid('id', 36);
            $table->uuid('invoice_id', 36); 
			$table->foreign('invoice_id')->references('invoice_id')->on('invoices');
            $table->float('item_sub_total',10,2)->nullable();
            $table->float('item_tax_total',10,2)->nullable();
            $table->float('discount_amount',10,2)->nullable();
            $table->float('total_amount',10,2)->nullable();
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
        Schema::dropIfExists('invoice_amounts');
    }
}
