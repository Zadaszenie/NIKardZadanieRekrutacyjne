@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 text-center" x-data="{ showInfo: true }">
        <h1 class="text-4xl font-bold mb-4">Witaj w Laravel Tasks App</h1>
        <p class="mb-6 text-gray-700">Zarządzaj swoimi zadaniami.</p>
        <div>
            @guest
                <a href="{{ route('login') }}" class="bg-green-500 text-black px-4 py-2 rounded mr-2">Logowanie</a>
                <a href="{{ route('register') }}" class="bg-blue-500 text-black px-4 py-2 rounded">Rejestracja</a>
            @else
                <a href="{{ route('tasks.index') }}" class="bg-purple-500 text-black px-4 py-2 rounded">Przejdź do zadań</a>
            @endguest
        </div>
    </div>
@endsection
