<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Tasks') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen">

@include('layouts.navigation')

<main class="py-6">
    @if(session('success'))
        <div class="container mx-auto mb-4 px-4">
            <div class="bg-green-500 text-gray-700 p-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
