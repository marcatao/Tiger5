<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Planos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->bigincrements('id')->unique();
            $table->string('titulo_plano');
            $table->string('desc_plano');
            $table->integer('duracao_dias');
            $table->decimal('valor_plano',8,2);
            $table->integer('user_id')->references('id')->on('users');
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
