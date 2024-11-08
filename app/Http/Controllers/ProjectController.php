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

        public function edit($id)
        {
            $project = Projects::findOrFail($id);  // Holt Projekt anhand der ID
        return view('projects.edit', compact('project'));
        }

        public function update(Request $request, $id) // Request-Parameter hinzufügen
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'status' => 'required|in:aktiv,pausiert'
    ]);

    $project = Projects::findOrFail($id);
    $project->update($validated);

    return redirect()
        ->route('projects.index')
        ->with('success', 'Projekt wurde erfolgreich aktualisiert!');
}

        public function destroy($id)
        {
            $project = Projects::findOrFail($id);
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projekt wurde erfolgreich gelöscht!');
        }
}
