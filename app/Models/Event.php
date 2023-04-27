<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    
    protected $fillable = [
        'name',
        'date',
        'location',
        'project_fk',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_fk');
    }
}

