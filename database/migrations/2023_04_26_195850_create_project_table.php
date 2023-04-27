<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('project_cod', 20);
            $table->string('name', 200);
            $table->string('description', 200);
            $table->date('delivery_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project');
    }
}
