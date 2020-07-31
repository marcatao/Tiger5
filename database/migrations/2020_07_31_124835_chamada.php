<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chamada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamada', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('professor_id')->references('id')->on('professor');
            $table->integer('aluno_id')->references('id')->on('aluno');
            $table->date('dt_aula');
            $table->time('hora_ini');
            $table->time('hora_fim');
            $table->integer('user_id')->references('id')->on('users');
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
