<x-guest-layout>
    <x-slot name="title">Регистрация — {{ config('app.name', 'Банкетам.Нет') }}</x-slot>

    <h1 class="text-lg font-semibold text-gray-800">Регистрация</h1>
    <p class="mt-1 text-sm text-gray-500">Все поля обязательны для заполнения.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-6">
        @csrf

        <div>
            <x-input-label for="login" value="Логин" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
            <p class="mt-1 text-xs text-gray-500">Латинские буквы и цифры, не менее 6 символов, уникален.</p>
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Пароль" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <p class="mt-1 text-xs text-gray-500">Не менее 8 символов.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Повтор пароля" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" value="ФИО" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" value="Контактный телефон" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" placeholder="+7 (912) 345-67-89" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>Зарегистрироваться</x-primary-button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-gray-100 text-center">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            Уже зарегистрированы? Войти
        </a>
    </div>
</x-guest-layout>
