<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlanosAulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas_plano', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plano_id')->references('id')->on('planos');
            $table->integer('aula_id')->references('id')->on('aulas');
            $table->integer('qtd_aulas');
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
