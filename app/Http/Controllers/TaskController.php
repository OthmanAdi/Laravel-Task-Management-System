<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Projects;
use Illuminate\Http\Request;


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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:neu,in_bearbeitung,abgeschlossen',
            'priority' => 'required|in:hoch,mittel,niedrig',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
        ]);

    //     Task::create($request-> all());
    //     return redirect()->route('tasks.index')->with('success', 'Aufgabe wurde erfolgreich erstellt');
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
