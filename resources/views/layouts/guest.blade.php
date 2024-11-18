<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="text-center mb-4">
            <!-- Laravel Logo -->
            <a href="/">
                <img src="https://via.placeholder.com/80" alt="Laravel Logo" class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <!-- Slot Content -->
            <div>
                <!-- Hier wird der Platzhalter für den Slot angezeigt -->
                <!-- Füge den Inhalt des Slots hier manuell ein, z.B. das Formular oder den Text. -->
                <!-- Beispiel: -->
                <h2 class="text-xl font-bold text-gray-800">Willkommen bei der Anmeldung</h2>
                <p class="text-gray-600">Bitte melden Sie sich an, um fortzufahren.</p>
            </div>
        </div>
    </div>

</body>
</html>
