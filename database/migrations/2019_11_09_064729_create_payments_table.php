<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('payments', function (Blueprint $table) {
           
            $table->uuid('payment_id')->primary();
            $table->uuid('invoice_id', 36);
			//$table->foreign('invoice_id')->references('invoice_id')->on('invoices');
            $table->float('payment_amount', 10,2);
            $table->uuid('paymenttype_id',36);
          //  $table->foreign('paymenttype_id')->references('id')->on('payment_methods');
            $table->string('cheque_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('dd_no')->nullable();
            $table->string('banktransaction_id')->nullable();
            $table->string('onlinetransaction_id')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
