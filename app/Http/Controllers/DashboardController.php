<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __invoke(){
        $openTasksCount = Task::whereIn('status',['neu', 'in_bearbeitung'])->count();

        $activeProjectsCount = Project::where('status','aktiv')->count();

        $overdueTasksCount = Task::where('due_date', '<' , now())->whereIn('status',['neu', 'in_bearbeitung'])->count();

        return view('dashboard.index', [
            'openTasksCount'=> $openTasksCount,
            'activeProjectsCount'=> $activeProjectsCount,
            'overdueTasksCount'=> $overdueTasksCount
        ]);
    }

}

