<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteStatusMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('quotes_status_master', function (Blueprint $table) {

            $table->uuid('quotesstatus_id',36)->primary();
            $table->string('quotesstatus',250);
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
        Schema::dropIfExists('quote_status_masters');
    }
}
