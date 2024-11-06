<?php

namespace App\Http\Controllers;


use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Projects::query();

        if ($request->status === 'active') {
            $query->where('status', 'aktiv');
        }

        $projects = $query->withCount('tasks')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
{

    return view('projects.create');
}


    public function store(){}

}
