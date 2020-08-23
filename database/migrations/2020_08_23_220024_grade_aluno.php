<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GradeAluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_aluno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gradeAula_id')->references('id')->on('GradeAula');
            $table->integer('aluno_id')->references('id')->on('aluno');

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
