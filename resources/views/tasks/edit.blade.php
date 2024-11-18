<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Aktualisieren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-semibold text-white">Task Aktualisieren</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-6 max-w-4xl">
            <section class="bg-white shadow-2xl rounded-xl p-8 border border-gray-200">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Task Bearbeiten</h2>
                <form id="updateTaskForm" method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT') <!-- Für Update-Anfragen -->

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                        <input type="text" name="title" id="title" required
                            value="{{ old('title', $task->title) }}"
                            class="mt-1 block w-full rounded-lg bg-white border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Beschreibung</label>
                        <textarea name="description" id="description" required
                            class="mt-1 block w-full rounded-lg bg-white border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="project_id" class="block text-sm font-medium text-gray-700">Projekt</label>
                        <select name="project_id" id="project_id" required
                            class="mt-1 block w-full rounded-lg bg-white border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full rounded-lg bg-white border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="neu" {{ old('status', $task->status) == 'neu' ? 'selected' : '' }}>Neu</option>
                            <option value="in_bearbeitung" {{ old('status', $task->status) == 'in_bearbeitung' ? 'selected' : '' }}>In Bearbeitung</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priorität</label>
                        <select name="priority" id="priority" required
                            class="mt-1 block w-full rounded-lg bg-white border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="niedrig" {{ old('priority', $task->priority) == 'niedrig' ? 'selected' : '' }}>Niedrig</option>
                            <option value="mittel" {{ old('priority', $task->priority) == 'mittel' ? 'selected' : '' }}>Mittel</option>
                            <option value="hoch" {{ old('priority', $task->priority) == 'hoch' ? 'selected' : '' }}>Hoch</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Fälligkeitsdatum</label>
                        <input type="date" name="due_date" id="due_date" required
                            value="{{ old('due_date', $task->due_date) }}"
                            class="mt-1 block w-full rounded-lg bg-white border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="updateTaskButton"
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-800 transition">
                            Task Aktualisieren
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 mt-12">
        <div class="container mx-auto text-center text-gray-300">
            <p>&copy; {{ date('Y') }} Task Manager. Alle Rechte vorbehalten.</p>
        </div>
    </footer>

    <script>
        // JavaScript für den SweetAlert und das Absenden des Formulars
        document.getElementById('updateTaskButton').addEventListener('click', function(e) {
            e.preventDefault(); // Verhindert das direkte Absenden des Formulars

            Swal.fire({
                position: 'middle',
                icon: 'success',
                title: 'Task wird aktualisiert...',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Formular nach dem SweetAlert absenden
                document.getElementById('updateTaskForm').submit();
            });
        });
    </script>

</body>
</html>
