<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesItemAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_item_amount', function (Blueprint $table) {
            $table->uuid('quotes_item_amount_id', 36)->primary();
            $table->uuid('quotes_id', 36);
            $table->foreign('quotes_id')->references('quotes_id')->on('quotes');
            $table->uuid('quotes_item_id');
            // $table->foreign('quotes_item_id')->references('item_id')->on('quotes_item')->onDelete('cascade');
            $table->string('tax_before_total')->nullable();
            $table->double('discount', 10, 2)->nullable();
            $table->double('tax', 10, 2)->nullable();
            $table->double('total_amount', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('quotes_item_id')->references('item_id')->on('quotes_item')->onDelete('cascade');
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes_item_amounts');
    }
}
