<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // was darf befuellt werden
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'project_id',
        'assigned_to',
        'created_by'
    ];

    // wie haengt einer task mit andere sachen zusammen
    public function project()
    {
        return $this->belongsTo(Project::class); // tasks gehoeren fur einer projekt
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');  // task gehoert zu einem user
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
