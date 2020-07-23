<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Aluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->string('nome');
            $table->string('sexo')->nullable();
            $table->date('dt_nacito');
            $table->string('tel')->nullable();
            $table->string('cel1')->nullable();;
            $table->string('operadora1')->nullable();
            $table->string('cel2')->nullable();
            $table->string('operadora2')->nullable();
            $table->string('email');            
            $table->string('cep')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('complemento')->nullable();        
            $table->string('foto')->nullable();
            $table->integer('academia_id');
            $table->foreign('academia_id')->references('id')->on('academias');
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
