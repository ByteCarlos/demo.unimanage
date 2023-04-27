<?php

// app/Models/InstructorTeam.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorTeam extends Model
{
    use HasFactory;

    protected $table = 'instructor_team';

    public $incrementing = false;

    protected $fillable = [
        'team_fk',
        'instructor_fk',
        'task_fk'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_fk');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_fk');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_fk');
    }
}

