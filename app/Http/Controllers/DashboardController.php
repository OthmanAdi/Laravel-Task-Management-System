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
       // Anzahl offener Aufgaben
    $openTasksCount = Tasks::whereIn('status', ['neu', 'in_bearbeitung'])->count();

    // Anzahl aktiver Projekte
    $activeProjectsCount = Projects::where('status', 'aktiv')->count();

    // Anzahl überfälliger Aufgaben
    $overdueTasksCount = Tasks::where('due_date', '<', now())
        ->whereIn('status', ['neu', 'in_bearbeitung'])->count();

    // Alle Aufgaben mit Projekten und Benutzern abrufen
    $tasks = Tasks::with('project', 'assignedUser')->latest()->get();

    // Überfällige Aufgaben abrufen
    $overdueTasks = Tasks::where('due_date', '<', now())
        ->whereIn('status', ['neu', 'in_bearbeitung'])
        ->get();


            $tasks = Tasks::with('project', 'assignedUser')->latest()->get();
            return view('dashboard.index', [
                'openTasksCount' => $openTasksCount,
                'activeProjectsCount' => $activeProjectsCount,
                'overdueTasksCount' => $overdueTasksCount,
                'tasks' => $tasks, // Hier die Aufgaben hinzufügen
                'overdueTasks' =>$overdueTasks
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
