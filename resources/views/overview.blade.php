<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white-100 dark:text-gray-200">
            {{ __('Übersicht deines Task Managers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 dark:text-white-100">
                    <h3 class="mb-4 text-lg font-bold">Willkommen im Task Manager!</h3>
                    <p class="mb-6">Hier findest du eine Übersicht über die verfügbaren Bereiche:</p>

                    <!-- Flexbox Container für horizontale Karten -->
                    <div class="flex flex-col gap-6 md:flex-row">

                         <!-- Karte: Dashboard -->
                         <a href="{{ route('dashboard') }}"
                         class="flex-1 p-6 bg-blue-200 dark:bg-blue-600 rounded-lg shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 ease-in-out">
                          <h4 class="text-2xl font-bold text-blue-700 dark:text-blue-200 mb-2">Dashboard</h4>
                          <p class="text-gray-700 dark:text-black-100">Erhalte eine Übersicht über alle Projekte und Aufgaben.</p>
                      </a>


                        <!-- Karte: Projekte -->
                        <a href="{{ route('projects.index') }}"
                           class="flex-1 p-6 bg-blue-200 dark:bg-green-600 rounded-lg shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 ease-in-out">
                            <h4 class="text-2xl font-bold text-green-700 dark:text-green-200 mb-2">Projekte</h4>
                            <p class="text-gray-800 dark:text-black-100">Verwalte deine Projekte und behalte den Überblick.</p>
                        </a>

                        <!-- Karte: Aufgaben -->
                        <a href="{{ route('tasks.index') }}"
                           class="flex-1 p-6 bg-yellow-200 dark:bg-yeelow-100 rounded-lg shadow-md  hover:bg-yellow-200 transform hover:-translate-y-1 transition-all duration-200 ease-in-out">
                            <h4 class="text-2xl font-bold text-yellow-600 dark:text-yellow-500 mb-2">Aufgaben</h4>
                            <p class="text-gray-700 dark:text-black-100">Sieh dir alle Aufgaben an oder erstelle neue.</p>
                        </a>



                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
