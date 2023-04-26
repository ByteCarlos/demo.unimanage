<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['project_cod', 'name', 'description', 'delivery_date'];

    public function teams()
    {
        return $this->hasMany(Team::class, 'project_fk');
    }
}
