<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnidadeProfessor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_professor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unidade_id')->references('id')->on('unidades');
            $table->integer('professor_id')->references('id')->on('professor');
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
