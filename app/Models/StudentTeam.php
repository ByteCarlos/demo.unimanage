<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTeam extends Model
{
    protected $table = 'student_team';

    protected $fillable = [
        'team_fk',
        'student_fk',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_fk', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_fk', 'id');
    }
}

