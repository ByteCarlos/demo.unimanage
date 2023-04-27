<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTable extends Migration
{
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('file', 200);
            $table->foreignId('project_fk')->constrained('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document');
    }
}


