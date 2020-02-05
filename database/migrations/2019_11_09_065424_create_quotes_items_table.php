<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_item', function (Blueprint $table) {
            $table->uuid('item_id', 36)->primary();
            $table->uuid('quote_id');
            $table->foreign('quote_id')->references('quotes_id')->on('quotes')->onDelete('cascade');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('productmaps');
            $table->string('product_name', 255)->nullable();
            $table->text('description')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->float('quotessubtotal', 10, 2)->default(00.00);
            $table->decimal('tax_rate_value')->nullable();
            $table->uuid('tax_rate_id')->nullable();
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates')->onDelete('cascade');
            $table->integer('display_order')->nullable();
            $table->boolean('status')->default(false)->comments('1 - Active, 0 - Inactive');
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
        Schema::dropIfExists('quotes_items');
    }
}
