<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vitrine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitrine', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produto');
            $table->string('descritivo')->nullable();
            $table->integer('ativo');
            $table->double('valor');
            $table->double('desconto')->nullable();
            $table->integer('exibe_valor');
            $table->datetime('dt_utilizacao')->nullable();
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
