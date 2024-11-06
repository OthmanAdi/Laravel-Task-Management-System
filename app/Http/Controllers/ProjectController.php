<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->status === 'active') {
            $query->where('status', 'aktiv');
        }

        $projects = $query->withCount('tasks')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function create(){}

    public function store(){}

}