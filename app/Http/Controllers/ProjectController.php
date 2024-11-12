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

    /**
     * Zeigt das Formular zur Erstellung eines neuen Projekts
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Speichert ein neues Projekt in der Datenbank
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validierung der eingehenden Daten
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:aktiv,pausiert'
        ]);

        // 2. Erstellen des neuen Projekts
        $project = Project::create($validated);

        // 3. Weiterleitung mit Erfolgsmeldung
        return redirect()
            ->route('projects.index')
            ->with('success', 'Projekt wurde erfolgreich erstellt!');
    }
}