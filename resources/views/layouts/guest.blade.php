<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PopArt Oglasi') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        @php
            $isAuthPage = request()->routeIs([
                'login',
                'register',
                'password.*',
                'verification.*',
            ]);
        @endphp

        {{-- NAVBAR --}}
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">

                {{-- Logo / Home link --}}
                <a href="{{ route('front.ads.index') }}" class="flex items-center space-x-2">
                    <span class="text-lg font-semibold text-gray-800">PopArt Oglasi</span>
                </a>

                {{-- Right side: Auth links --}}
                <div class="flex items-center space-x-4 text-sm">
                    @auth
                        {{-- Link ka customer dashboard-u --}}
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">
                            Moj profil
                        </a>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600">
                                Logout
                            </button>
                        </form>
                    @else
                        {{-- Gost --}}
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- SADRŽAJ --}}
        @if($isAuthPage)
            {{-- LOGIN / REGISTER / PASSWORD – centrirana kartica, kao ranije --}}
            <main class="py-8">
                <div class="min-h-[calc(100vh-80px)] flex flex-col sm:justify-center items-center px-4">
                    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        @else
            {{-- FRONT STRANICE (oglasi) – širok layout --}}
            <main class="py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        @endif

    </body>
</html>
