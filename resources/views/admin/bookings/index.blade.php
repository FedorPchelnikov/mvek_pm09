<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Панель администратора
        </h2>
    </x-slot>

    @if (session('status'))
        <x-toast :message="session('status')" />
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="flex flex-wrap items-end gap-4">
                        <input type="hidden" name="direction" value="{{ $direction }}">

                        <div>
                            <x-input-label for="filter-status" value="Статус заявки" />

                            <select id="filter-status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Все статусы</option>

                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected($currentStatus === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-primary-button>Применить</x-primary-button>

                        <a href="{{ route('admin.bookings.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Сбросить
                        </a>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <h3 class="text-base font-semibold text-gray-800">Всего заявок: {{ $bookings->total() }}</h3>

                        @if ($direction === 'desc')
                            <a href="{{ request()->fullUrlWithQuery(['direction' => 'asc']) }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                                Сначала старые
                            </a>
                        @else
                            <a href="{{ request()->fullUrlWithQuery(['direction' => 'desc']) }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                                Сначала новые
                            </a>
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="mt-4 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead>
                                <tr class="text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    <th class="px-3 py-2">№</th>
                                    <th class="px-3 py-2">Пользователь</th>
                                    <th class="px-3 py-2">Помещение</th>
                                    <th class="px-3 py-2">Дата банкета</th>
                                    <th class="px-3 py-2">Заявка создана</th>
                                    <th class="px-3 py-2">Оплата</th>
                                    <th class="px-3 py-2">Статус</th>
                                    <th class="px-3 py-2">Действие</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td class="px-3 py-3 text-gray-500">{{ $booking->id }}</td>
                                        <td class="px-3 py-3">
                                            <div class="text-gray-900">{{ $booking->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->user->login }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-gray-900">{{ $booking->premise->label() }}</td>
                                        <td class="px-3 py-3 text-gray-900">{{ $booking->banquet_date->format('d.m.Y') }}</td>
                                        <td class="px-3 py-3 text-gray-900">{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                                        <td class="px-3 py-3 text-gray-900">{{ $booking->payment_method->label() }}</td>
                                        <td class="px-3 py-3">
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $booking->status->badgeClasses() }}">
                                                {{ $booking->status->label() }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <div x-data="{ confirming: false }">
                                                <form x-ref="statusForm" method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="flex items-center gap-2" @submit.prevent="confirming = true">
                                                    @csrf
                                                    @method('PATCH')

                                                    <select x-ref="statusSelect" name="status" class="block rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                        @foreach ($statuses as $value => $label)
                                                            <option value="{{ $value }}" @selected($booking->status->value === $value)>{{ $label }}</option>
                                                        @endforeach
                                                    </select>

                                                    <x-secondary-button type="submit">Сменить</x-secondary-button>
                                                </form>

                                                <template x-if="confirming">
                                                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 p-4">
                                                        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl">
                                                            <h4 class="text-base font-semibold text-gray-800">Подтвердите изменение</h4>

                                                            <p class="mt-2 text-sm text-gray-600">
                                                                Заявка №{{ $booking->id }}. Новый статус —
                                                                «<span x-text="$refs.statusSelect.options[$refs.statusSelect.selectedIndex].text"></span>».
                                                            </p>

                                                            <div class="mt-5 flex justify-end gap-3">
                                                                <x-secondary-button type="button" @click="confirming = false">Отмена</x-secondary-button>
                                                                <x-primary-button type="button" @click="confirming = false; $refs.statusForm.submit()">Подтвердить</x-primary-button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-3 py-6 text-center text-gray-500">Заявки не найдены.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
