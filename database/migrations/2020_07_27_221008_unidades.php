<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Unidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('sub_titulo');
            $table->string('end1');
            $table->string('end2');
            $table->string('end3');
            $table->string('whats');
            $table->string('responsavel');
            $table->string('insta');
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
