<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white-100 dark:text-gray-200">
            {{ __('Task Aktualisieren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT') <!-- Für Update-Anfragen -->

                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required
                            value="{{ old('title', $task->title) }}"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500 mb-4">

                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" required
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500 mb-4">{{ old('description', $task->description) }}</textarea>

                        <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                        <select name="project_id" id="project_id" required
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500 mb-4">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500 mb-4">
                            <option value="neu" {{ old('status', $task->status) == 'neu' ? 'selected' : '' }}>Neu</option>
                            <option value="in_bearbeitung" {{ old('status', $task->status) == 'in_bearbeitung' ? 'selected' : '' }}>In Bearbeitung</option>
                        </select>

                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                        <select name="priority" id="priority" required
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500 mb-4">
                            <option value="niedrig" {{ old('priority', $task->priority) == 'niedrig' ? 'selected' : '' }}>Niedrig</option>
                            <option value="mittel" {{ old('priority', $task->priority) == 'mittel' ? 'selected' : '' }}>Mittel</option>
                            <option value="hoch" {{ old('priority', $task->priority) == 'hoch' ? 'selected' : '' }}>Hoch</option>
                        </select>

                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="date" name="due_date" id="due_date" required
                            value="{{ old('due_date', $task->due_date) }}"
                            class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-600 focus:ring-indigo-500 mb-4">

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-800 transition-colors">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
