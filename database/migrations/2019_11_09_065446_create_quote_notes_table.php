<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('quote_notes', function (Blueprint $table) {
            $table->uuid('note_id',36)->primary();
            $table->uuid('quotes_id'); 
            $table->foreign('quotes_id')->references('quotes_id')->on('quotes');
            $table->text('note')->nullable();
            $table->integer('display_order')->nullable();
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
        Schema::dropIfExists('quote_notes');
    }
}
