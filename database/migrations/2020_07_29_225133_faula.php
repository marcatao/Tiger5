<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Faula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Faula', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('aluno_id')->references('id')->on('aluno');
            $table->integer('professor_id')->references('id')->on('professor')->nullable();
            $table->integer('maula_id')->references('id')->on('Maula');
            $table->integer('aula_id')->references('id')->on('aulas');
            $table->date('dt_inicio');
            $table->date('dt_fim');
            $table->datetime('dt_utilizacao')->nullable();
            $table->integer('status_id')->references('id')->on('status');
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
