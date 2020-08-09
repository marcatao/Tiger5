<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notificacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('to_user_id')->references('id')->on('user');
            $table->datetime('dt_ocorrencia');
            $table->string('icon');
            $table->string('mensagem');
            $table->integer('user_id')->references('id')->on('user');
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
