<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicetriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('invoicetries', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->string('invoice_number', 36)->nullable();
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('company_address', 255)->nullable();
			$table->string('bill_to')->nullable();
            $table->string('terms')->nullable();
            $table->string('footer')->nullable(); 
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
        Schema::dropIfExists('invoicetries');
    }
}
