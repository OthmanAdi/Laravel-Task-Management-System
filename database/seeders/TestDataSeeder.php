<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //erstelle ein test0benutzer, wenn das noch nicht existiert
        //firstOrCreate verhindert dopplte eintage

        $user = User::firstOrCreate(
        ['email'=>'test@example.com'],
            [
                'name'=> 'Test User',
                'password'=> Hash::make('password'),
            ]
            );

           //erstelle ein aktives Projekt

        $activeProject = Project::create([
            'name'=> 'Aktives Project 1',
            'description'=> 'Ein Aktives TestProjekt für die Entwicklung',
            'status' => 'aktiv'
        ]);

        Project::create([
            'name'=> 'Pausierte Projekt 1',
            'description'=> 'Ein Pausiertes TestProjekt',
            'status'=> 'pausiert'
            ]);


            Task::create([
                'title' => 'Task 1',
                'description'=> 'Basic Task 1',
                'status'=> 'neu',
                'priority' => 'hoch',
                'due_date'=> Carbon::now()->addDays(5), //faelling IN 5 tagen
                'project_id' => $activeProject->id,
                'assigned_to'=> $user->id,
                'created_by' => $user->id
            ]);

            Task::create([
                'title' => 'Task 2',
                'description'=> 'Basic Task 2',
                'status'=> 'in_bearbeitung',
                'priority' => 'mittel',
                'due_date'=> Carbon::now()->addDays(3), //faelling IN 5 tagen
                'project_id' => $activeProject->id,
                'assigned_to'=> $user->id,
                'created_by' => $user->id
            ]);
            Task::create([
                'title' => 'Task 3',
                'description'=> 'Basic Task 3',
                'status'=> 'neu',
                'priority' => 'hoch',
                'due_date'=> Carbon::now()->addDays(2), //faelling IN 5 tagen
                'project_id' => $activeProject->id,
                'assigned_to'=> $user->id,
                'created_by' => $user->id
            ]);


    }
}
