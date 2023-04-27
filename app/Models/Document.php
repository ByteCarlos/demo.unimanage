<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model    
{
    use HasFactory;

    protected $fillable = ['title', 'file', 'project_fk'];

    protected $table = 'document';

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_fk');
    }
}
