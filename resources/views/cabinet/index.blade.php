<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Личный кабинет
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <x-slider :count="4" />
                </div>
            </div>

            <div>
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h3 class="text-base font-semibold text-gray-800">Мои заявки</h3>

                    <a href="{{ route('bookings.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">
                        Оформить заявку
                    </a>
                </div>

                @if ($bookings->isEmpty())
                    <p class="mt-3 text-sm text-gray-500">У вас пока нет заявок.</p>
                @else
                    <div class="mt-4 space-y-4">
                        @foreach ($bookings as $booking)
                            <article id="booking-{{ $booking->id }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex flex-wrap items-start justify-between gap-4">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $booking->premise->label() }}</h4>

                                            <dl class="mt-2 grid grid-cols-1 gap-x-8 gap-y-1 text-sm sm:grid-cols-2">
                                                <div class="flex gap-2">
                                                    <dt class="text-gray-500">Дата начала банкета:</dt>
                                                    <dd class="text-gray-900">{{ $booking->banquet_date->format('d.m.Y') }}</dd>
                                                </div>
                                                <div class="flex gap-2">
                                                    <dt class="text-gray-500">Способ оплаты:</dt>
                                                    <dd class="text-gray-900">{{ $booking->payment_method->label() }}</dd>
                                                </div>
                                                <div class="flex gap-2">
                                                    <dt class="text-gray-500">Заявка создана:</dt>
                                                    <dd class="text-gray-900">{{ $booking->created_at->format('d.m.Y H:i') }}</dd>
                                                </div>
                                            </dl>
                                        </div>

                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $booking->status->badgeClasses() }}">
                                            {{ $booking->status->label() }}
                                        </span>
                                    </div>

                                    @if ($booking->review)
                                        <div class="mt-4 rounded-md bg-gray-50 p-4">
                                            <p class="text-sm font-medium text-gray-800">
                                                Ваш отзыв, оценка {{ $booking->review->rating }} из 5
                                            </p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $booking->review->text }}</p>
                                        </div>
                                    @elseif ($booking->canBeReviewed())
                                        <form method="POST" action="{{ route('reviews.store', $booking) }}" class="mt-4 border-t border-gray-100 pt-4">
                                            @csrf

                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                                                <div>
                                                    <x-input-label for="rating-{{ $booking->id }}" value="Оценка" />

                                                    <select id="rating-{{ $booking->id }}" name="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                        @for ($rating = 5; $rating >= 1; $rating--)
                                                            <option value="{{ $rating }}" @selected(old('rating', 5) == $rating)>{{ $rating }}</option>
                                                        @endfor
                                                    </select>

                                                    @if (old('booking_id') == $booking->id)
                                                        <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                                    @endif
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <x-input-label for="text-{{ $booking->id }}" value="Отзыв о полученных услугах" />

                                                    <textarea id="text-{{ $booking->id }}" name="text" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('booking_id') == $booking->id ? old('text') : '' }}</textarea>

                                                    @if (old('booking_id') == $booking->id)
                                                        <x-input-error :messages="$errors->get('text')" class="mt-2" />
                                                    @endif
                                                </div>
                                            </div>

                                            <x-primary-button class="mt-3">Отправить отзыв</x-primary-button>
                                        </form>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
