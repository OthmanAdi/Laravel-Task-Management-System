<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white-100 dark:text-gray-200">
            {{ __('Projekt Aktualisiert') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold">{{ $project->name }}</h3>
                    <p>{{ $project->description }}</p>
                    <p>Status: {{ $project->status }}</p>
                    <p>Erstellt am: {{ $project->created_at->format('d.m.Y') }}</p>
                </div>
            </div>
        </div>
    </div>
   <a href="{{ route('projects.index') }}"
    class="inline-flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 transition duration-200 ease-in-out dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Zurück zu Projekten
   </a>
</x-app-layout>
