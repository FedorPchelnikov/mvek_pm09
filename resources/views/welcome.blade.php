<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Банкетам.Нет') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col justify-center items-center px-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name', 'Банкетам.Нет') }}</h1>
            <p class="mt-3 max-w-xl text-center text-gray-600">
                Портал бронирования помещений для проведения банкетов: зал, ресторан, летняя веранда, закрытая веранда.
            </p>

            <div class="mt-8 flex items-center gap-4">
                @auth
                    <a href="{{ route('cabinet') }}" class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-500">
                        Личный кабинет
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-500">
                        Войти
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Регистрация
                    </a>
                @endauth
            </div>
        </div>
    </body>
</html>
