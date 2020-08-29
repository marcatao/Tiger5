<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parcerias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcerias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_capa');
            $table->string('sub_titulo');
            $table->string('titulo');
            $table->string('texto');
            $table->integer('academia_id')->references('id')->on('academias');
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
        //
    }
}
