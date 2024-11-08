<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Tasks::query();

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




    public function create()
    {
        $projects = Projects::all();
        return view('tasks.create', compact ('projects')); // gibt die Seite wo man Aufgaben erstellen kann zurück.

    }


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



    public function show(Tasks $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Tasks $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Tasks $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:neu,in_bearbeitung,abgeschlossen',
            'priority' => 'required|in:hoch,mittel,niedrig',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Aufgabe erfolgreich aktualisiert.');
    }

    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Aufgabe erfolgreich gelöscht.');
    }
}
