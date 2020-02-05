<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_methods', function (Blueprint $table) {
            $table->uuid('id',36)->primary();
            $table->string('name');
            $table->string('slug',100)->nullable();
            $table->string('description',400)->nullable();
            $table->string('image',200)->nullable();
            $table->integer('position');
            $table->uuid('parentcategory');
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
        Schema::dropIfExists('category_methods');
    }
}
