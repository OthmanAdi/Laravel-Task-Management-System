<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Filter basierend auf Status-Parameter
        if ($request->status === 'open') {
            $query->whereIn('status', ['neu', 'in_bearbeitung']);
        } elseif ($request->status === 'overdue') {
            $query->where('due_date', '<', now())
                ->whereIn('status', ['neu', 'in_bearbeitung']);
        }

        $tasks = $query->with(['project', 'assignedUser'])
            ->latest()
            ->get();            
        return view('tasks.index', compact('tasks'));
    }
        
            // erstelle die Create funktion
        public function create(){
            $projects = Project::all();
            return view('tasks.create', compact('projects'));
        }
            
            // erstelle die Store funktion
        public function store(){}

}