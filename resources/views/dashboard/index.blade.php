<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Übersicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-600 text-white flex flex-col h-screen shadow-lg">
        <div class="py-6 text-center border-b border-blue-700">
            <h1 class="text-2xl font-bold">Task Manager</h1>
        </div>
        <nav class="flex-grow">
            <ul class="mt-8 space-y-2 px-4">
                <li>
                    <a href="/Calender" class="flex items-center px-4 py-2 text-blue-200 hover:text-white hover:bg-blue-500 rounded-md">
                        <span class="ml-3">Kalender</span>
                    </a>
                </li>
                <li>
                    <a href="/TimeManager" class="flex items-center px-4 py-2 text-blue-200 hover:text-white hover:bg-blue-500 rounded-md">
                        <span class="ml-3">Time Manager</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.index') }}" class="flex items-center px-4 py-2 text-blue-200 hover:text-white hover:bg-blue-500 rounded-md">
                        <span class="ml-3">Aufgaben</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects.index') }}" class="flex items-center px-4 py-2 text-blue-200 hover:text-white hover:bg-blue-500 rounded-md">
                        <span class="ml-3">Projekte</span>
                    </a>
                </li>
            </ul>
        </nav>
        <footer class="py-4 text-center border-t border-blue-700">
            <p class="text-sm">&copy; {{ date('Y') }} Task Manager</p>
        </footer>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <!-- Header -->
        <header class="flex justify-between items-center bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
            <div class="flex items-center space-x-4">
                <!-- Profile & Logout -->
                <div class="relative">
                    <!-- Benutzername anzeigen -->
                    <button id="profileButton" class="flex items-center text-gray-800 hover:text-gray-600 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-5 w-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menü -->
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-10">
                        <ul>
                            <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-200">Abmelden</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Overview Cards -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Offene Aufgaben</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $openTasksCount }}</p>
                </div>
                <div class="text-blue-600 text-5xl">📋</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Aktive Projekte</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $activeProjectsCount }}</p>
                </div>
                <div class="text-green-600 text-5xl">📊</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Überfällige Aufgaben</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $overdueTasksCount }}</p>
                </div>
                <div class="text-yellow-600 text-5xl">⚠️</div>
            </div>
        </section>

        <!-- Overdue Tasks Section -->
        <section class="mt-12 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Überfällige Aufgaben</h3>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Titel</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Projekt</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Fällig am</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($overdueTasks as $task)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-4">{{ $task->title }}</td>
                            <td class="px-4 py-4">{{ $task->project->name ?? 'Kein Projekt' }}</td>
                            <td class="px-4 py-4 text-red-600 font-bold">{{ $task->due_date->format('d.m.Y') }}</td>
                            <td class="px-4 py-4 flex space-x-4">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">Bearbeiten</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Sind Sie sicher?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Löschen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <!-- JavaScript für das Dropdown -->
    <script>
        document.getElementById('profileButton').addEventListener('click', function() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('hidden'); // Schaltet das Dropdown-Menü ein/aus
        });

        // Schließt das Dropdown, wenn der Benutzer außerhalb des Menüs klickt
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const button = document.getElementById('profileButton');
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
