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
    public function create() {
        $projects = Projects::all();
        return view('tasks.create', compact('projects'));

    }

    public function store(Request $request) {
        //Validierung der eingegebenen daten

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:neu,in_bearbeitung',
            'priority' => 'required|in:niedrig,mittel,hoch',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task = Tasks::create([
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

         return redirect()
         ->route('tasks.index')
         ->with('success', 'aufgabe wurde erfolgreich erstellt!');
    }
    public function destroy(Tasks $task)
{
    $task->delete();

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Aufgabe wurde erfolgreich gelöscht.');
}
public function edit($id)
        {
            $tasks = Tasks::findOrFail($id);
        return view('tasks.edit', compact('tasks'));
        }

}
