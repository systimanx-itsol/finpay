<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->uuid('quotes_id', 36)->primary();
            $table->uuid('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('quote_no', 255)->nullable();
            $table->uuid('company_id', 36)->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->date('expires_on')->nullable();
            $table->decimal('discountpercentage', 10, 2)->default('0.00');
            $table->uuid('currencies_id')->nullable();
            $table->foreign('currencies_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->string('summary')->nullable();
            $table->text('terms')->nullable();
            $table->text('footer')->nullable();
            $table->string('files')->nullable();
            $table->string('quote_template', 36);
            $table->uuid('quotes_status_id')->nullable();
            $table->foreign('quotes_status_id')->references('quotesstatus_id')->on('quotes_status_master')->onDelete('cascade');
            $table->string('invoice_id')->nullable();
            // $table->string('invoice_id')->references('quotes_id')->on('invoice')->onDelete('cascade');
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
        Schema::dropIfExists('quotes');
    }
}
