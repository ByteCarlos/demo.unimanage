<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->date('date');
            $table->string('location', 200);
            $table->foreignId('project_fk')->constrained('projects');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event');
    }
}
