@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-4">{{ $task->title }}</h1>

        <p class="mb-2"><strong>Opis:</strong> {{ $task->description }}</p>
        <p class="mb-2"><strong>Status:</strong> {{ $statuses[$task->status] }}</p>
        <p class="mb-2"><strong>Data wykonania:</strong> {{ $task->due_date?->format('Y-m-d') }}</p>
        <p class="mb-2"><strong>Właściciel:</strong> {{ $task->user->name }}</p>
        <p class="mb-2"><strong>Obserwator:</strong> {{ $task->observer?->name ?? '-' }}</p>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-gray-700 px-4 py-2 rounded">Powrót</a>
            @can('update', $task)
                <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-gray-700 px-4 py-2 rounded">Edytuj</a>
            @endcan
            @can('delete', $task)
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" x-data @submit.prevent="if(confirm('Na pewno usunąć?')) $el.submit()">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Usuń</button>
                </form>
            @endcan
        </div>
    </div>
@endsection
