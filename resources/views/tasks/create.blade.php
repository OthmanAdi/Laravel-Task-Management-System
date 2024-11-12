<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Neue Aufgabe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Added method and action --}}
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                                required value="{{ old('title') }}"> {{-- Added old value --}}
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                                required>{{ old('description') }}</textarea> {{-- Added old value --}}
                        </div>

                        <div class="mb-4">
                            <label for="project_id" class="block text-sm font-medium text-gray-700">Projects
                                Selection:</label>
                            <select name="project_id" id="project_id"
                                class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                                required>
                                <option value="">Projekt auswählen</option> {{-- Added empty default option --}}
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status: </label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                                    required>
                                    <option value="">Status auswählen</option> {{-- Added empty default option --}}
                                    <option value="neu" {{ old('status') == 'neu' ? 'selected' : '' }}>Neu</option>
                                    <option value="in_bearbeitung"
                                        {{ old('status') == 'in_bearbeitung' ? 'selected' : '' }}>In Bearbeitung
                                    </option>
                                </select>
                            </div>

                            <div> {{-- Moved priority inside grid --}}
                                <label for="priority" class="block text-sm font-medium text-gray-700">Priority: </label>
                                <select name="priority" id="priority"
                                    class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                                    required>
                                    <option value="">Priorität auswählen</option> {{-- Added empty default option --}}
                                    <option value="niedrig" {{ old('priority') == 'niedrig' ? 'selected' : '' }}>Niedrig
                                    </option>
                                    <option value="mittel" {{ old('priority') == 'mittel' ? 'selected' : '' }}>Mittel
                                    </option> {{-- Fixed typo --}}
                                    <option value="hoch" {{ old('priority') == 'hoch' ? 'selected' : '' }}>Hoch
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date: </label>
                            <input type="date" name="due_date" id="due_date"
                                class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500"
                                required value="{{ old('due_date') }}"> {{-- Added old value --}}
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-800 transition-colors">
                                Submit New Task
                            </button> {{-- Fixed missing closing button tag --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
