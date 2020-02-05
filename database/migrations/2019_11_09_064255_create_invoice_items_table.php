<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('invoice_items', function (Blueprint $table) {
            $table->uuid('item_id', 36)->primary();
            $table->uuid('invoice_id', 36)->nullable();
			$table->foreign('invoice_id')->references('invoice_id')->on('invoices');
            $table->uuid('product_id', 36)->nullable();
            $table->foreign('Product_id')->references('id')->on('productmaps');
            $table->string('product_name', 255)->nullable();
            $table->text('description')->nullable();
            $table->float('quantity', 10,2)->nullable(); 
            $table->float('price', 10,2)->default(00.00);
            $table->float('tax_value', 10,2)->nullable();
            $table->float('total', 10,2)->default(00.00);
            $table->uuid('tax_rate_id', 36)->nullable();
			$table->foreign('tax_rate_id')->references('id')->on('tax_rates');
            $table->integer('display_order')->nullable();
            $table->boolean('status')->default(true)->comments('1 - Active, 0 - Inactive');
            $table->softdeletes();
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
        Schema::dropIfExists('invoice_items');
    }
}
