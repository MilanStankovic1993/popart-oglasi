{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'PopArt Oglasi') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen">

    {{-- Gornja Breeze navigacija (logo + user dropdown) --}}
    @include('layouts.navigation')

    <div class="flex">

        {{-- LEVI SIDEBAR za ulogovane korisnike --}}
        @auth
            <aside class="hidden md:block w-64 bg-white border-r border-gray-200 min-h-[calc(100vh-4rem)]">
                <div class="px-4 py-3 border-b">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        Navigacija
                    </p>
                </div>

                <nav class="px-3 py-4 space-y-1 text-sm">
                    @if(auth()->user()->role === 'admin')
                        {{-- ADMIN MENI --}}
                        <x-nav-link href="{{ route('admin.dashboard') }}"
                                    :active="request()->routeIs('admin.dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link href="{{ route('admin.customers.index') }}"
                                    :active="request()->routeIs('admin.customers.*')">
                            Customers
                        </x-nav-link>

                        <x-nav-link href="{{ route('admin.categories.index') }}"
                                    :active="request()->routeIs('admin.categories.*')">
                            Kategorije
                        </x-nav-link>

                        <x-nav-link href="{{ route('admin.ads.index') }}"
                                    :active="request()->routeIs('admin.ads.*')">
                            Oglasi
                        </x-nav-link>
                    @else
                        {{-- CUSTOMER MENI --}}
                        <x-nav-link href="{{ route('dashboard') }}"
                                    :active="request()->routeIs('dashboard')">
                            Moj profil / oglasi
                        </x-nav-link>

                        <x-nav-link href="{{ route('customer.ads.create') }}"
                                    :active="request()->routeIs('customer.ads.create')">
                            + Novi oglas
                        </x-nav-link>
                    @endif

                    <hr class="my-3">

                    {{-- Link ka front delu oglasa --}}
                    <x-nav-link href="{{ route('front.ads.index') }}"
                                :active="request()->routeIs('front.ads.*')">
                        Pregled oglasa (front)
                    </x-nav-link>
                </nav>
            </aside>
        @endauth

        {{-- DESNA STRANA: header + sadržaj --}}
        <div class="flex-1 min-h-[calc(100vh-4rem)] flex flex-col">

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>
