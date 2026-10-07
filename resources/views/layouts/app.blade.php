<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Catálogo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Catálogo</h1>
        <div>
            <span>Hola, {{ auth()->user()->name ?? 'Invitado' }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-600 ml-3">Cerrar Sesión</button>
            </form>
        </div>
    </header>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
