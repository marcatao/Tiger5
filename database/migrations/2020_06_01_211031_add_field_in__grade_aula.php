<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInGradeAula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('GradeAula', function (Blueprint $table) {
            $table->integer('professor_id')->nullable();
            $table->foreign('professor_id')->references('id')->on('professor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('GradeAula', function (Blueprint $table) {
            //
        });
    }
}
