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
    
    /**
     * Zeigt das Formular zur Erstellung eines neuen Tasks
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }
    
    /**
     * Speichert einen neuen Task in der Datenbank
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validierung der eingehenden Daten
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:neu,in_bearbeitung',
            'priority' => 'required|in:niedrig,mittel,hoch',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id'
        ]);

        // 2. Erstellen des neuen Tasks mit den validierten Daten
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
            'project_id' => $validated['project_id'],
            // Automatisch den eingeloggten Benutzer als Ersteller setzen
            'created_by' => auth()->id(),
            // Vorläufig den eingeloggten Benutzer auch als Bearbeiter setzen
            'assigned_to' => auth()->id(),
        ]);

        // 3. Weiterleitung mit Erfolgsmeldung
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Aufgabe wurde erfolgreich erstellt!');
    }
}