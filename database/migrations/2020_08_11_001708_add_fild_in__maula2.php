<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFildInMaula2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Maula', function (Blueprint $table) {
            $table->integer('sub')->nullable();
            $table->foreign('sub')->references('id')->on('Maula')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_maula2', function (Blueprint $table) {
            //
        });
    }
}
