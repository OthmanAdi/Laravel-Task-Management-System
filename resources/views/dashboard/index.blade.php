<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4 text-lg font-bold">Übersicht</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <!-- Offene Aufgaben -->
                        <div class="p-4 bg-blue-100 rounded hover:bg-blue-200 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-blue-700">Offene Aufgaben</h4>

                                    <p class="text-2xl text-blue-900">{{ $openTasksCount }}</p>
                                </div>
                                <div class="text-3xl text-blue-500">
                                    📋
                                </div>
                            </div>
                        </div>

                        <!-- Aktive Projekte -->
                        <div class="p-4 bg-green-100 rounded hover:bg-green-200 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-green-700">Aktive Projekte</h4>
                                    <p class="text-2xl text-green-900">{{ $activeProjectsCount }}</p>

                                </div>
                                <div class="text-3xl text-green-500">
                                    📊
                                </div>
                            </div>
                        </div>

                        <!-- Fällige Aufgaben -->
                        <div class="p-4 bg-yellow-100 rounded hover:bg-yellow-200 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-yellow-700">Fällige Aufgaben</h4>

                                     <p class="text-2xl text-yellow-900">{{ $overdueTasksCount }}</p>
                                </div>
                                <div class="text-3xl text-yellow-500">
                                    ⚠️
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

