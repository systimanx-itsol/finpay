<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('product_units', function (Blueprint $table) {
            $table->uuid('id',36)->primary();
            $table->string('name',200);
            $table->string('unit',200);
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
        Schema::dropIfExists('productunits');
    }
}
