<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_notes', function (Blueprint $table) {
            $table->uuid('note_id', 36)->primary();
			  $table->uuid('invoice_id', 36); 
			 $table->foreign('invoice_id')->references('invoice_id')->on('invoices');
			 $table->string('note')->nullable();
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
        Schema::dropIfExists('invoice_notes');
    }
}
