<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('tasks.index') }}" class="text-xl font-bold text-gray-800">Laravel Tasks</a>


        <div class="flex items-center space-x-4">
            @auth
                <span class="text-gray-700">Użytkownik: {{ Auth::user()->name }}</span>
                <form method="GET" action="{{ route('dashboard') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-gray-700 px-3 py-1 rounded">Twoje zadania</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-gray-700 px-3 py-1 rounded">Wyloguj</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 text-gray-700 px-3 py-1 rounded">Logowanie</a>
                <a href="{{ route('register') }}" class="bg-green-500 text-gray-700 px-3 py-1 rounded">Rejestracja</a>
            @endauth
        </div>
    </div>
</nav>
