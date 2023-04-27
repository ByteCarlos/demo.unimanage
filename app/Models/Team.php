<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'orientador_fk', 'project_fk'];

    protected $table = 'team';

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, 'orientador_fk');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_fk');
    }
}
