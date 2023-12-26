<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ABC Bank</title>

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
    <nav class="bg-white border-gray-200">
        <div class="relative flex items-top justify-center min-h-16 bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-gray-700 dark:text-gray-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-gray-700 dark:text-gray-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>
    <div class="container min-h-screen mx-auto">
        <div class="min-h-screen flex items-center justify-center">
            <h3 class="text-3xl text-gray-600">
                Welcome to ABC Bank
            </h3>
        </div>
    </div>
    </body>
</html>
