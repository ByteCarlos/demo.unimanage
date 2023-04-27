<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'project_fk',
        'location',
        'link',
        'modality',
        'team_fk',
        'instructor_fk',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_fk');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_fk');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_fk');
    }
}
