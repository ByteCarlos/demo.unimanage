<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorTable extends Migration
{
    public function up()
    {
        Schema::create('instructor', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('cpf', 20);
            $table->unsignedBigInteger('user_fk');
            $table->unsignedBigInteger('institution_fk');
            $table->timestamps();

            $table->foreign('user_fk')->references('id')->on('users');
            $table->foreign('institution_fk')->references('id')->on('institutions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('instructor');
    }
}
