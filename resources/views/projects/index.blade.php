<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Projekte') }}
        </h2>
        <a href="{{ route('projects.create') }}"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
            Neues Projekt
        </a>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font medium text-gray-500 uppercase tracking-wider">
                                        Tasks
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font medium text-gray-500 uppercase tracking-wider">
                                        Aktionen
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $project->name }}
                                        </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{$projekt->status === 'aktiv' ? 'bg-green-100 text-green-800' :
                                            ($project->status === 'pausiert' ? 'bg-yellow-100 text-yellow-800' :
                                            'bg-gray-100 text-grau-800') }}">
                                            {{ $project->status }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $project->tasks_count ?? 0 }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('projects.show', $project) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                        Details
                                        </a>

                                        <a href="{{ route('projects.edit', $project) }}"
                                        class="text-green-600 hover:text-green-900 mr-3">
                                         Bearbeiten
                                     </a>

                                     <form action="{{ route('projects.destroy', $project) }}"
                                           method="POST"
                                           class="inline">
                                         @csrf
                                         @method('DELETE')

                                         <button type="submit"
                                                 class="text-red-600 hover:text-red-900"
                                                 onclick="return confirm('Wirklich löschen?')">
                                             Löschen
                                         </button>
                                     </form>
                                 </td>
                             </tr>
                         @empty
                             <tr>
                                 <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                     Keine Projekte gefunden
                                 </td>
                             </tr>
                         @endforelse
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
</div>
</x-app-layout>
