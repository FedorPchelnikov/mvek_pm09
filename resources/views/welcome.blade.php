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
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <a href="{{ route('home') }}" class="text-lg font-bold text-gray-800 hover:text-indigo-600">
                        {{ config('app.name', 'Банкетам.Нет') }}
                    </a>

                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ route('cabinet') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                Личный кабинет
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Выйти
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                Войти
                            </a>
                            <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">
                                Регистрация
                            </a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <main>
            <section class="bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <h1 class="text-3xl font-bold text-gray-800">Банкетам.Нет</h1>
                    <p class="mt-3 max-w-3xl text-gray-600">
                        Портал бронирования помещений для проведения банкетов: зал, ресторан, летняя веранда, закрытая веранда.
                    </p>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <x-slider :images="$gallery" />
            </section>

            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
                <h2 class="text-xl font-semibold text-gray-800">Помещения</h2>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($premises as $premise)
                        <article class="overflow-hidden rounded-lg bg-white shadow-sm">
                            <img src="{{ asset($premise->image()) }}" alt="{{ $premise->label() }}" class="h-40 w-full object-cover">

                            <div class="p-4">
                                <h3 class="font-medium text-gray-800">{{ $premise->label() }}</h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                <div class="rounded-lg bg-indigo-50 p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-800">Бронирование помещения</h2>
                    <p class="mt-2 max-w-3xl text-sm text-gray-600">
                        Выберите нужное помещение, укажите удобную дату начала банкета и способ оплаты — заявка будет записана в базу данных и отправлена на согласование администратору.
                    </p>

                    @if (Route::has('bookings.create'))
                        <a href="{{ route('bookings.create') }}" class="mt-5 inline-block rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-500">
                            Оформить заявку
                        </a>
                    @endif
                </div>
            </section>
        </main>

        <footer class="border-t border-gray-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-gray-500">
                {{ config('app.name', 'Банкетам.Нет') }} — портал бронирования помещений для проведения банкетов, {{ date('Y') }}
            </div>
        </footer>
    </body>
</html>
