<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600 hover:text-blue-700">Task Manager</a>
            <div class="flex items-center space-x-6">
                <a href="/dashboard" class="text-gray-600 hover:text-blue-500 font-medium">Home</a>
                <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-blue-500 font-medium">Aufgaben</a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 py-6 shadow-md">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-white">Projekte</h1>
            <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
                + Neues Projekt
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-6 max-w-7xl">
            <section class="bg-white shadow-lg rounded-xl p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Alle Projekte</h2>
                <table class="min-w-full table-auto border-collapse divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Projektname</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Aufgaben</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($projects as $project)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $project->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $project->status === 'aktiv' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $project->tasks_count }}</td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('projects.edit', $project) }}" class="text-blue-500 hover:text-blue-700 font-medium">Bearbeiten</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Sind Sie sicher, dass Sie dieses Projekt löschen möchten?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Löschen</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 mt-12">
        <div class="container mx-auto text-center text-gray-300">
            <p>&copy; {{ date('Y') }} Task Manager. Alle Rechte vorbehalten.</p>
        </div>
    </footer>

</body>
</html>
