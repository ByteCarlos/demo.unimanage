<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_team', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_fk');
            $table->unsignedBigInteger('student_fk');
            $table->foreign('team_fk')->references('id')->on('team')->onDelete('cascade');
            $table->foreign('student_fk')->references('id')->on('student')->onDelete('cascade');
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
        Schema::dropIfExists('students_team');
    }
}
