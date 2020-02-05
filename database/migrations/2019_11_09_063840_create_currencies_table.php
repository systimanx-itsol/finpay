<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code');
            $table->string('name');
            $table->string('symbol');
            $table->string('placement');
            $table->string('decimal');
            $table->string('thousands');
            $table->tinyInteger('status')->default('0')->comments('0-inactive , 1-active ');
            $table->softdeletes();        //it used to delete in the view page but it will not deleted in database and deleted time gets stored and dispayed
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
        Schema::dropIfExists('currencies');
    }
}
