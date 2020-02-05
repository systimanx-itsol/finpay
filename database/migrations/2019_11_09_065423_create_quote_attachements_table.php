<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAttachementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('quote_attachements', function (Blueprint $table) {
            $table->uuid('attachment_id')->primary();
            $table->uuid('quotes_id'); 
            $table->foreign('quotes_id')->references('quotes_id')->on('quotes');
            $table->string('file_name',255)->nullable();
            $table->string('file_type',255)->nullable();
            $table->string('file_size')->nullable();
            $table->string('file_path',255)->nullable();
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
        Schema::dropIfExists('quote_attachements');
    }
}
