@extends('layouts.app')

@php
    $code = $code ?? 500;
    $title = $title ?? 'Błąd';
    $message = $message ?? 'Wystąpił nieoczekiwany błąd.';

    $colors = [
        403 => 'text-red-600',
        404 => 'text-yellow-500',
        500 => 'text-gray-800',
    ];
    $color = $colors[$code] ?? 'text-gray-800';
@endphp

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md text-center">
            <h1 class="text-5xl font-bold {{ $color }} mb-4">{{ $code }}</h1>
            <h2 class="text-2xl font-semibold mb-2">{{ $title }}</h2>
            <p class="mb-4">{{ $message }}</p>
            <button x-data @click="window.history.back()" class="px-4 py-2 bg-blue-500 text-gray-700 rounded hover:bg-blue-600">Wróć</button>
        </div>
    </div>
@endsection
