<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GradeAula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
    Schema::create('GradeAula', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('user_id');
        $table->integer('aula_id');
        $table->integer('academia_id');
        $table->string('dia');
        $table->integer('status_id');
        $table->foreign('academia_id')->references('id')->on('academias');
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('aula_id')->references('id')->on('aulas');
        $table->foreign('status_id')->references('id')->on('StatusAula');
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
