<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->string('company_name', 250);
            $table->string('logo', 250)->nullable();
            $table->text('address');
            $table->string('landmark', 250)->nullable();
            $table->string('city', 250);
            $table->string('state', 250)->nullable();
            $table->string('country', 250);
            $table->string('zipcode', 250); 
            $table->string('phone', 250)->nullable();
            $table->string('fax', 250)->nullable();
            $table->string('mobile', 250)->nullable();
            $table->string('website', 250)->nullable();
            $table->string('VAT_verification_number', 250)->nullable();
            $table->string('tax_code', 250)->nullable();
            $table->string('IBAN', 250)->nullable();
            $table->string('subscriber_number', 250)->nullable();
            $table->string('default_invoice_template', 250);
            $table->string('default_quote_template', 250);
            $table->boolean('status')->default(true)->comments('1 - Active, 0 - Inactive');
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
        Schema::dropIfExists('companies');
    }
}
