<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_amount', function (Blueprint $table) {
            $table->uuid('quotes_amount_id', 36)->primary();
            $table->uuid('quotes_id');
            $table->foreign('quotes_id')->references('quotes_id')->on('quotes')->onDelete('cascade');
            $table->string('itemsubtotal', 255)->nullable();
            $table->double('itemtaxtotal', 10, 2)->nullable();
            $table->double('discount')->nullable();
            $table->double('totalamount', 10, 2)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('quote_amounts');
    }
}
