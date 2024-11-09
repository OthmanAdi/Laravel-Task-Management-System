
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Aufgaben') }}
            </h2>
            <a href="{{ route('tasks.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                Neue Aufgabe
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Projekt</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fällig am
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktionen
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4">{{ $task->title }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $task->status === 'neu'
                                                ? 'bg-gray-100 text-gray-800'
                                                : ($task->status === 'in_bearbeitung'
                                                    ? 'bg-blue-100 text-blue-800'
                                                    : 'bg-green-100 text-green-800') }}">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $task->project->name ?? 'Kein Projekt zugeordnet' }}</td>
                                    <td class="px-6 py-4">{{ $task->due_date->format('d.m.Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('tasks.edit', $task) }}"
                                            class="text-blue-600 hover:text-blue-900">Bearbeiten</a>
                                             </td>
                                            <!-- Delete Button -->
                                            <td>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Sind Sie sicher, dass Sie diese Aufgabe löschen möchten?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                        Löschen
                                                    </button>
                                                </form>
                                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
