<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('invoice_attachments', function (Blueprint $table) {
            $table->uuid('Attachment_id', 36)->primary();
			  $table->uuid('invoice_id', 36); 
			 $table->foreign('invoice_id')->references('invoice_id')->on('invoices');
			 $table->string('file_name')->nullable();
			 $table->string('file_type')->nullable();
			 $table->integer('file_size')->nullable();
			$table->string('file_path')->nullable();
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
        Schema::dropIfExists('invoice_attachments');
    }
}
