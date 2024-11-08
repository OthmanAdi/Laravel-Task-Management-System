<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'project_id');
    }
}
