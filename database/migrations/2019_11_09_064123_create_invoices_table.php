<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('invoice_id', 36)->primary();
            $table->uuid('user_id', 36)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
             $table->uuid('company_id', 36)->nullable();
			$table->foreign('company_id')->references('id')->on('companies');
            $table->uuid('client_id', 36);
			$table->foreign('client_id')->references('id')->on('clients');
            $table->string('invoice_number', 255)->nullable();
            $table->date('date')->nullable();
            $table->date('expires_on')->nullable();
            $table->float('discount', 10,2)->default('0');
            $table->uuid('currency_id')->nullable();
            $table->string('summary', 255)->nullable();
			$table->string('file')->nullable();
            $table->string('terms')->nullable();
            $table->string('footer')->nullable(); 
            $table->uuid('invoice_template')->nullable();
            $table->uuid('invoice_status_id')->nullable();
            $table->float('balance', 10,2)->default('00.00');
             $table->float('total', 10,2)->default('00.00');
            $table->float('total_paid_amount', 10,2)->default('00.00');
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
        Schema::dropIfExists('invoices');
    }
}
