@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-2xl"
             x-data="{ showObserver: {{ isset($task) && $task->observer_id ? 'true' : 'false' }} }">

            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                {{ isset($task) ? 'Edytuj zadanie' : 'Dodaj nowe zadanie' }}
            </h1>

            <form method="POST"
                  action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}"
                  class="space-y-6">
                @csrf
                @if(isset($task))
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tytuł</label>
                    <input type="text" name="title"
                           placeholder="Tytuł zadania"
                           value="{{ old('title', $task->title ?? '') }}"
                           class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg w-full p-3 shadow-sm" />
                    @error('title')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Opis</label>
                    <textarea name="description" rows="4"
                              placeholder="Krótki opis zadania"
                              class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg w-full p-3 shadow-sm">{{ old('description', $task->description ?? '') }}</textarea>
                    @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                            class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg w-full p-3 shadow-sm">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" @selected(old('status', $task->status ?? '')==$key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Termin</label>
                    <input type="date" name="due_date"
                           value="{{ old('due_date', isset($task)?$task->due_date?->format('Y-m-d'):'') }}"
                           class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg w-full p-3 shadow-sm" />
                    @error('due_date')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center cursor-pointer text-sm font-medium text-gray-700">
                        <input type="checkbox" x-model="showObserver"
                               class="mr-2 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        Przypisz obserwatora
                    </label>

                    <select name="observer_id" x-show="showObserver"
                            class="mt-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg w-full p-3 shadow-sm">
                        <option value="">Brak obserwatora</option>
                        @foreach($observers as $observer)
                            <option value="{{ $observer->id }}" @selected(old('observer_id', $task->observer_id ?? '')==$observer->id)>
                                {{ $observer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('observer_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-gray-700 font-semibold px-6 py-3 rounded-lg shadow-md transition">
                        {{ isset($task) ? 'Zapisz zmiany' : 'Dodaj zadanie' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
