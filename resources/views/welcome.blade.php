<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gradient-to-b from-blue-600 via-blue-500 to-blue-800 text-white flex flex-col min-h-screen">

    <!-- Navigation -->
    <header class="w-full bg-blue-800 shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold">Task Management</a>
            <div>
                @if (Route::has('login'))
                    <div class="flex items-center space-x-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-300 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-300 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-blue-300 transition">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col justify-center items-center text-center py-16 px-4">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6">Willkommen beim Task Management System</h1>
        <p class="text-lg md:text-xl mb-8">Organisieren Sie Ihre Aufgaben effizient und mühelos.</p>

        <!-- Auth Links -->
        @auth
            <a href="{{ route('overview') }}"
               class="px-8 py-4 bg-blue-700 text-lg font-semibold rounded-full shadow-xl transition duration-300 ease-in-out transform hover:scale-105 hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-500">
                Go to Overview
            </a>
        @else
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-blue-600 text-lg font-semibold rounded-full shadow-xl transition duration-300 ease-in-out transform hover:scale-105 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-3 border-2 border-white text-lg font-semibold rounded-full shadow-xl transition duration-300 ease-in-out transform hover:scale-105 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500">
                    Register
                </a>
            </div>
        @endauth
    </main>

    <!-- Footer -->
    <footer class="bg-blue-800 py-6">
        <div class="container mx-auto text-center text-white">
            <p class="text-sm">&copy; 2024 Task Management System. Alle Rechte vorbehalten.</p>
        </div>
    </footer>
</body>
</html>
