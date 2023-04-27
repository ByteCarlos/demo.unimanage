<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('project_fk');
            $table->string('location')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('modality');
            $table->unsignedBigInteger('team_fk');
            $table->unsignedBigInteger('instructor_fk');
            $table->timestamps();
            
            $table->foreign('project_fk')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('team_fk')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('instructor_fk')->references('id')->on('instructors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting');
    }
}

