<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTable extends Migration
{
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->unsignedBigInteger('orientador_fk');
            $table->unsignedBigInteger('project_fk');
            $table->timestamps();
            
            $table->foreign('orientador_fk')->references('id')->on('orientador');
            $table->foreign('project_fk')->references('id')->on('project');
        });
    }

    public function down()
    {
        Schema::dropIfExists('team');
    }
}
