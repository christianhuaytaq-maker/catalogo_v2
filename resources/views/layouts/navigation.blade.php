<nav class="mb-4 flex justify-end gap-4">
    @auth
        <span>Hola, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500">Cerrar Sesión</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="text-blue-500">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="text-blue-500">Registrarse</a>
    @endauth
</nav>