@extends('layouts.app')


@section('content')
    <div class="container mx-auto p-4 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-4">{{ $title ?? 'Task App' }}</h1>
        <p>{{ $slot ?? 'Treść strony' }}</p>
    </div>
@endsection
