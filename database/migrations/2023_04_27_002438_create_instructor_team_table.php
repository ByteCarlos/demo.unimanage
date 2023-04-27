<?php
// database/migrations/{timestamp}_create_instructor_team_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_team', function (Blueprint $table) {
            $table->foreignId('team_fk')->constrained('teams');
            $table->foreignId('instructor_fk')->constrained('instructors');
            $table->foreignId('task_fk')->constrained('tasks');
            $table->primary(['team_fk', 'instructor_fk', 'task_fk']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_team');
    }
}
