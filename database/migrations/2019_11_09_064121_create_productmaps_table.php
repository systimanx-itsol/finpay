<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('productmaps', function (Blueprint $table) {
          $table->uuid('id', 36)->primary();
		  $table->uuid('product_id', 36);
		  $table->float('price', 10,2);
          $table->string('weight', 5);
          $table->string('unit', 5);
          $table->string('image', 200);
          $table->string('display_name', 300)->nullable();
          $table->boolean('status')->default(true)->comments('1 - Active, 0 - Inactive');
          $table->softdeletes();
          $table->timestamps(); 
		  $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productmaps');
    }
}
