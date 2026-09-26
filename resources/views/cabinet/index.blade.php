<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Личный кабинет
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-base font-semibold text-gray-800">Данные пользователя</h3>

                    <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="text-gray-500">ФИО</dt>
                            <dd class="mt-1 text-gray-900">{{ auth()->user()->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Логин</dt>
                            <dd class="mt-1 text-gray-900">{{ auth()->user()->login }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Телефон</dt>
                            <dd class="mt-1 text-gray-900">{{ auth()->user()->phone }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">E-mail</dt>
                            <dd class="mt-1 text-gray-900">{{ auth()->user()->email }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
