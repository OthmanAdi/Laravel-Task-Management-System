<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Http\Request;


class DashboardController extends Controller
{

    public function index()
    {
        // Anzahl der offenen Aufgaben
        // $openTasksCount = Tasks::where('status', 'active')->count();
        $openTasksCount = Tasks::whereIn('status', ['neu','in_bearbeitung'])->count();


        // Anzahl der aktiven Projekte
        $activeProjectsCount = Projects::where('status', 'aktiv')->count();



        // Anzahl der überfälligen Aufgaben
        $overdueTasksCount = Tasks::where('due_date' , '<', now())
                                   ->whereIn('status',['neu', 'in_bearbeitung'])->count();

        // Daten an die View übergeben
            return view('dashboard.index', [
            'openTasksCount' => $openTasksCount,
            'activeProjectsCount' => $activeProjectsCount,
            'overdueTasksCount' => $overdueTasksCount
        ]);
    }

        //Übersichtsseite
        public function overview()
        {
            return view('overview');
        }

}






