@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6" x-data="{ showStats: true }">
        <h1 class="text-3xl font-bold mb-4">Panel użytkownika</h1>

        <button @click="showStats = !showStats" class="bg-blue-500 text-gray-700 px-3 py-1 rounded mb-4">
            <span x-text="showStats ? 'Ukryj' : 'Pokaż'"></span> statystyki
        </button>

        <div x-show="showStats" x-transition class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 borde">
            <div class="p-4 bg-green-100 rounded shadow">
                <h2 class="text-xl font-semibold">Twoje zadania</h2>
                <p class="text-2xl font-bold">{{ auth()->user()->tasks()->count() }}</p>
            </div>
            <div class="p-4 bg-yellow-100 rounded shadow">
                <h2 class="text-xl font-semibold">Obserwowane zadania</h2>
                <p class="text-2xl font-bold">{{ auth()->user()->observedTasks()->count() }}</p>
            </div>
            <div class="p-4 bg-red-100 rounded shadow">
                <h2 class="text-xl font-semibold">Zadania zakończone</h2>
                <p class="text-2xl font-bold">{{ auth()->user()->tasks()->where('status', 'done')->count() }}</p>
            </div>
        </div>

        <div>
            <a href="{{ route('tasks.index') }}" class="bg-purple-500 text-gray-700 px-4 py-2 rounded">Przejdź do listy zadań</a>
        </div>
    </div>
@endsection
