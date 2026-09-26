<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Оформление заявки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="premise" value="Помещение" />

                            <select id="premise" name="premise" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required autofocus>
                                <option value="" disabled @selected(old('premise') === null)>Выберите помещение</option>

                                @foreach ($premises as $value => $label)
                                    <option value="{{ $value }}" @selected(old('premise') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('premise')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="banquet_date" value="Дата начала банкета" />

                            <x-text-input
                                id="banquet_date"
                                class="block mt-1 w-full sm:w-64"
                                type="text"
                                name="banquet_date"
                                :value="old('banquet_date')"
                                placeholder="ДД.ММ.ГГГГ"
                                maxlength="10"
                                inputmode="numeric"
                                required
                                x-data="{
                                    maskDate(event) {
                                        const digits = event.target.value.replace(/\D/g, '').slice(0, 8);
                                        event.target.value = digits.length > 4
                                            ? digits.slice(0, 2) + '.' + digits.slice(2, 4) + '.' + digits.slice(4)
                                            : (digits.length > 2 ? digits.slice(0, 2) + '.' + digits.slice(2) : digits);
                                    },
                                }"
                                @input="maskDate($event)"
                            />

                            <p class="mt-1 text-xs text-gray-500">Формат: ДД.ММ.ГГГГ, например 25.12.2026.</p>

                            <x-input-error :messages="$errors->get('banquet_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="payment_method" value="Способ оплаты" />

                            <select id="payment_method" name="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="" disabled @selected(old('payment_method') === null)>Выберите способ оплаты</option>

                                @foreach ($paymentMethods as $value => $label)
                                    <option value="{{ $value }}" @selected(old('payment_method') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>Отправить заявку</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
