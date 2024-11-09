<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method to show the dashboard
    public function index()
    {
        // Alle Projekte mit Aufgaben abfragen
        $openTasksCount = Tasks::whereIn('status', ['neu', 'in_bearbeitung'])->count();
        $activeProjectsCount = Projects::where('status', 'aktiv')->count();
        $overdueTasksCount = Tasks::where('due_date', '<', now())
            ->whereIn('status', ['neu', 'in_bearbeitung'])->count();

            $tasks = Tasks::with('project', 'assignedUser')->latest()->get();
            return view('dashboard.index', [
                'openTasksCount' => $openTasksCount,
                'activeProjectsCount' => $activeProjectsCount,
                'overdueTasksCount' => $overdueTasksCount,
                'tasks' => $tasks, // Hier die Aufgaben hinzufügen
            ]);
    }

    // Method to show the overview page
    public function overview()
    {
        return view('overview');
    }

    // Method to show the logged-in user dashboard
    public function loggin()
    {
        return view('dashboard');
    }
}
