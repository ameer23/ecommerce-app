<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'E-Commerce App' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased bg-gray-50">
        {{-- Simple Navigation Bar --}}
        <nav class="bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <a href="/" class="text-xl font-bold">E-Commerce</a>
                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-black">Profile</a>
                                <livewire:logout />
                            </div>
                        @else
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-black">Log In</a>
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-black">Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>