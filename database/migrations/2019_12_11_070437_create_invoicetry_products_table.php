<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicetryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('invoicetry_products', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->uuid('invoicetry_id', 36)->nullable();
			$table->foreign('invoicetry_id')->references('id')->on('invoicetries');
            $table->string('product', 255)->nullable();
            $table->text('description')->nullable();
            $table->float('quantity', 10,2)->nullable(); 
            $table->float('price', 10,2)->nullable();
            $table->float('tax', 10,2)->nullable();
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
        Schema::dropIfExists('invoicetry_products');
    }
}
