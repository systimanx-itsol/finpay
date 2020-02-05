<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('products', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->uuid('category_id');
            $table->string('product_name', 200); 
            $table->string('slug', 200)->nullable();
            $table->text('description');
            $table->boolean('status')->default(true)->comments('1 - Active, 0 - Inactive');
            $table->softdeletes();
            $table->timestamps();
			$table->uuid('tax_rate_id',36);
			 $table->foreign('tax_rate_id')->references('id')->on('tax_rates');
			 // $table->foreign('category_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
