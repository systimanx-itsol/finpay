<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->string('client_name', 250);
            $table->string('email', 250)->unique;
            $table->text('address');
            $table->string('land_mark', 250)->nullable();
            $table->string('city', 250);
            $table->string('state', 250)->nullable();
            $table->string('postal_code', 250)->nullable();
            $table->string('country', 250);
            $table->string('fax_number', 250)->nullable();
            $table->string('mobile_number', 250)->nullable();
            $table->string('zipcode', 250)->nullable();
            $table->string('phone_number', 250)->nullable();
            $table->string('web_site', 250)->nullable();
            $table->string('default_currency', 250)->nullable();
            $table->string('VAT_identification_no', 250)->nullable();
            $table->string('tax_code', 250)->nullable();
            $table->string('IBAN', 250)->nullable();
            $table->string('subscriber_number', 250)->nullable();
            $table->boolean('status')->default(false)->comments('1 - Active, 0 - Inactive')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
