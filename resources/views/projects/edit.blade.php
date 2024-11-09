<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white-100 dark:text-gray-200">
            {{ __('Projekt Aktualisieren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Projektbearbeitungsformular --}}
                    <form method="POST" action="{{ route('projects.update', $project->id) }}">
                        @csrf
                        @method('PUT') <!-- Fügt die PUT-Methode für das Update hinzu -->

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Projektname
                            </label>

                          <!-- zeigt alten Wert oder Projektnamen -->
                            <input type="text" name="name" id="name"
                            value="{{ old('name', $project->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Beschreibung
                            </label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Status
                            </label>
                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="aktiv" {{ $project->status == 'aktiv' ? 'selected' : '' }}>Aktiv</option>
                                <option value="pausiert" {{ $project->status == 'pausiert' ? 'selected' : '' }}>Pausiert</option>
                            </select>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                                Projekt Aktualisieren
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
