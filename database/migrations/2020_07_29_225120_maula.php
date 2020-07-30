<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Maula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Maula', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('valor_plano',8,2);
            $table->decimal('valor_pago',8,2);
            $table->date('dt_aquisicao');
            $table->date('dt_pagamento');
            $table->integer('aluno_id')->references('id')->on('aluno');
            $table->integer('plano_id')->references('id')->on('planos');
            $table->integer('formapagamento_id')->references('id')->on('FormaPagamento');
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
