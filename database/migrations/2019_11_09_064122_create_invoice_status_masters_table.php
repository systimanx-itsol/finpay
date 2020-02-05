<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceStatusMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('invoice_status_master', function (Blueprint $table) {
                      $table->uuid('invoicestatus_id',36)->primary();
            $table->string('invoicestatus',250)->nullable();
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
        Schema::dropIfExists('invoice_status_masters');
    }
}
