<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil verwalten</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased dark:bg-gray-900">

    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/dashboard" class="text-2xl font-bold text-blue-600 dark:text-white">Task Manager</a>
            <div class="flex items-center space-x-6">

                <a href="/tasks" class="text-gray-600 dark:text-gray-300 hover:text-blue-500">Aufgaben</a>
                <a href="/projects" class="text-gray-600 dark:text-gray-300 hover:text-blue-500">Projekte</a>
                <a href="/profile" class="text-gray-600 dark:text-gray-300 hover:text-blue-500">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-red-500">Abmelden</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 py-8 shadow-md">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold text-white">Profil verwalten</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto max-w-5xl">

            <!-- Profilinformationen aktualisieren -->
            <section class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-8 mb-10">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Profilinformationen aktualisieren</h2>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <!-- Passwort aktualisieren -->
            <section class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-8 mb-10">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Passwort ändern</h2>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <!-- Account löschen -->
            <section class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Account löschen</h2>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 dark:bg-gray-800 py-6 mt-12">
        <div class="container mx-auto text-center text-gray-600 dark:text-gray-300">
            &copy; {{ date('Y') }} Task Manager. Alle Rechte vorbehalten.
        </div>
    </footer>
</body>
</html>
