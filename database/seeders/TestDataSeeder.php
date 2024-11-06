<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Projects;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;


class TestDataSeeder extends Seeder
{

    public function run(): void
    {
        //erstelle ein Testbenutzer wenn das noch nicht existiert
        //firstOrCreate verhindert doppelte einträge

        $user = User::firstOrCreate(
            ['email' => 'test@examle.com'],
            ['name' => 'Test user',
            'password'=> Hash::make('password'),
        ]

        );

        //Erstelle ein aktives Project

        $activeProject =Projects::create([
            'name' => 'Aktives Projekt 1',
            'description' => 'Ein Actives Project für die Entwicklung',
            'status' => 'aktiv'
        ]);


        Projects::create([
            'name' => 'Aktives Projekt 1',
            'description' => 'Ein Actives Project für die Entwicklung',
            'status' => 'aktiv'
        ]);


        Tasks::create([
            'title' => 'Task 1',
            'description' => 'DOS 0',
            'status' => 'neu',
            'priority' => 'hoch',
            'due_date' =>Carbon::now()->addDays(5), //Fällig in 5 Tagen
            'project_id' => $activeProject ->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id


        ]);
        Tasks::create([
            'title' => 'Task 2',
            'description' => 'DOS 1',
            'status' => 'in_bearbeitung',
            'priority' => 'mittel',
            'due_date' =>Carbon::now()->addDays(3), //Fällig in 3 Tagen
            'project_id' => $activeProject ->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id


        ]);
        Tasks::create([
            'title' => 'Task 3',
            'description' => 'DOS 2',
            'status' => 'neu',
            'priority' => 'hoch',
            'due_date' =>Carbon::now()->addDays(2), //Fällig in 2 Tagen
            'project_id' => $activeProject ->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id


        ]);
    }
}
