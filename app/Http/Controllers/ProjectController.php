<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Projects::query();

        if ($request->status === 'active') {
            $query->where('status', 'aktiv');
        }

        $projects = $query->withCount('tasks')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
        }

        public function create()
        {
            return view('projects.create');
        }

        public function store(Request $request) {
            $validate = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'status' => 'required|in:aktiv,pausiert'
            ]);

            $project = Projects::create($validate);

            return redirect()
            ->route('projects.index')
            ->with('success', 'Projekt wurde erfolgreich erstellt!');
        }


}
