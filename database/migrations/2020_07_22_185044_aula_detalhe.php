<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AulaDetalhe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula_detalhe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('texto');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->Integer('aula_id')->references('id')->on('aulas');
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
