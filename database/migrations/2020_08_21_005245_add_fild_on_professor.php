<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFildOnProfessor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professor', function (Blueprint $table) {
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('sexo')->nullable();
            $table->string('tel')->nullable();
            $table->string('cel1')->nullable();;
            $table->string('operadora1')->nullable();
            $table->string('cel2')->nullable();
            $table->string('operadora2')->nullable();
            $table->string('cep')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('complemento')->nullable();        
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
