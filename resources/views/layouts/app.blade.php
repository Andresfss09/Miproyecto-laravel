<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fuentes -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            <!-- Navbar personalizada -->
            <nav class="bg-gray-800 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <div class="flex items-center space-x-4">
                            <a href="{{ url('/') }}" class="text-lg font-semibold hover:text-gray-300">Inicio</a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                                <a href="{{ route('products.index') }}" class="hover:text-gray-300">Productos</a>
                            @endauth
                        </div>

                        <div class="flex items-center space-x-3">
                            @auth
                                <!-- Usuario autenticado -->
                                <span class="text-sm text-gray-300">Hola, {{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                        Cerrar sesión
                                    </button>
                                </form>
                            @else
                                <!-- Usuario invitado -->
                                <a href="{{ route('login') }}" class="text-sm hover:text-gray-300">Iniciar sesión</a>
                                <a href="{{ route('register') }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded">
                                   Registrarse
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Encabezado de página -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Contenido principal -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
