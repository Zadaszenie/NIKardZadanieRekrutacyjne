@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-4" x-data="{ showFilters: false }">
        <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <h1 class="text-3xl font-bold text-gray-800">Zadania</h1>
                <a href="{{ route('tasks.create') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-black px-5 py-2 rounded-lg shadow transition">
                    ➕ Dodaj zadanie
                </a>
            </div>

            <div class="mb-6">
                <button @click="showFilters = !showFilters"
                        class="bg-gray-600 hover:bg-gray-700 text-black px-4 py-2 rounded-lg transition">
                    🔍 Filtry
                </button>

                <div x-show="showFilters" x-transition
                     class="mt-4 p-6 bg-gray-50 border rounded-lg shadow-inner space-y-4">

                    <form method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Szukaj</label>
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Wpisz frazę..."
                                   class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status"
                                    class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2 shadow-sm">
                                <option value="">Wszystkie</option>
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" @selected(request('status')==$key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Termin od</label>
                            <input type="date" name="due_from" value="{{ request('due_from') }}"
                                   class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Termin do</label>
                            <input type="date" name="due_to" value="{{ request('due_to') }}"
                                   class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Na stronę</label>
                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                            <select name="per_page"
                                    onchange="this.form.querySelector('input[name=page]').value = 1; this.form.submit();"
                                    class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2 shadow-sm">
                                @foreach([10, 20, 50] as $size)
                                    <option value="{{ $size }}" @selected((int)request('per_page', 10) === $size)>
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-6 text-right">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-gray-700 px-6 py-2 rounded-lg shadow transition">
                                Filtruj
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex mb-4">
                <form method="GET" class="flex items-center">
                    <input type="hidden" name="page" value="{{ request('page', 1) }}">
                    @foreach(request()->except(['page','per_page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <label for="perPage" class="mr-2 text-sm text-gray-700">Na stronę:</label>
                    <select id="perPage"
                            name="per_page"
                            onchange="this.form.querySelector('input[name=page]').value = 1; this.form.submit();"
                            class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2 shadow-sm px-6">
                        @foreach([10, 20, 50] as $size)
                            <option value="{{ $size }}" @selected((int)request('per_page', 10) === $size)>
                                {{ $size }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Tabela -->
            <div class="overflow-x-auto p-4">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100 border-b border-gray-200">
                            <tr class="text-left text-gray-700 text-sm uppercase tracking-wide">
                                <th class="px-6 py-3 border-r border-gray-200">Tytuł</th>
                                <th class="px-6 py-3 border-r border-gray-200">Opis</th>
                                <th class="px-6 py-3 border-r border-gray-200">Status</th>
                                <th class="px-6 py-3 border-r border-gray-200">Termin</th>
                                <th class="px-6 py-3 border-r border-gray-200">Właściciel</th>
                                <th class="px-6 py-3 border-r border-gray-200">Obserwator</th>
                                <th class="px-6 py-3 text-center">Akcje</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($tasks as $task)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 border-r border-gray-200 font-medium text-gray-900">{{ $task->title }}</td>
                                    <td class="px-6 py-4 border-r border-gray-200 text-gray-600">{{ Str::limit($task->description, 50) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-200">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold"
                                            title="Status: {{ $task->status }}"
                                            @class([
                                                'bg-blue-100 text-blue-800' => $task->status === 'new',
                                                'bg-yellow-100 text-yellow-800' => $task->status === 'in_progress',
                                                'bg-green-100 text-green-800' => $task->status === 'done',
                                            ])
                                        >
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border-r border-gray-200 text-gray-600">{{ $task->due_date?->format('Y-m-d') ?? '-' }}</td>
                                    <td class="px-6 py-4 border-r border-gray-200 text-gray-600">{{ $task->user->name }}</td>
                                    <td class="px-6 py-4 border-r border-gray-200 text-gray-600">{{ $task->observer?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                                        @can('update', $task)
                                            <a href="{{ route('tasks.edit', $task) }}"
                                               class="bg-yellow-500 hover:bg-yellow-600 text-gray-700 px-3 py-1 rounded-md text-sm transition">
                                                ✏️ Edytuj
                                            </a>
                                        @endcan
                                        @can('delete', $task)
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" x-data="{ confirmDelete: false }"
                                                  @submit.prevent="if(confirmDelete || (confirmDelete = confirm('Na pewno usunąć?'))) $el.submit()">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-600 hover:bg-red-700 text-gray-700 px-3 py-1 rounded-md text-sm transition">
                                                    🗑 Usuń
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">Brak zadań do wyświetlenia.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
@endsection
