<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = ['name', 'cpf', 'user_fk', 'institution_fk'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_fk');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_fk');
    }
}
