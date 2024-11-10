<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Task;
use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Tasks::with('project');

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

    // Create-Methode
    public function create(){
        $projects = Projects::all();
        return view('tasks.create', compact('projects'));
    }

    // Store-Methode zum Speichern einer neuen Aufgabe
    public function store(Request $request)
    {
        // Validierung der eingegebenen Daten
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',  // Optional, also ohne "required"
            'status' => 'required|in:neu,in_bearbeitung',
            'priority' => 'required|in:niedrig,mittel,hoch',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',  // Projekt muss existieren
        ]);

        // Aufgabe erstellen
        $task = Tasks::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
            'project_id' => $validated['project_id'],
            'created_by' => auth()->id(),  // Aktuellen Benutzer als Ersteller setzen
            'assigned_to' => auth()->id(), // Vorläufig denselben Benutzer als Bearbeiter setzen
        ]);

        // Nach dem Speichern weiterleiten
        return redirect()->route('tasks.index')->with('success', 'Aufgabe wurde erfolgreich erstellt!');
    }

    // Delete-Methode zum Löschen einer Aufgabe
    public function destroy(Tasks $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Aufgabe wurde erfolgreich gelöscht.');
    }

    // Edit-Methode zum Bearbeiten einer Aufgabe
    public function edit($id)
{
    $task = Tasks::findOrFail($id);
    $projects = Projects::all();
    return view('tasks.edit', compact('task', 'projects'));
}

public function show($id)
        {
            $task = Tasks::findOrFail($id);
            return view ('tasks.show',compact('task'));
        }



        public function update(Request $request, $id)
        {
            $validated = $request->validate([
                'description' => 'required',
                'status' => 'required',
                'priority' => 'required',
                'due_date' => 'required',
                'project_id' => 'required',
            ]);

            $task = Tasks::findOrFail($id);
             $task->update($validated);

    return redirect()
        ->route('tasks.show', $task->id)
        ->with('success', 'Task wurde erfolgreich aktualisiert!');
        }
}


