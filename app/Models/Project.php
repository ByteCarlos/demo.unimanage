<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['project_cod', 'name', 'description', 'delivery_date'];

    public function team()
    {
        return $this->hasOne(Team::class, 'project_fk');
    }
}
