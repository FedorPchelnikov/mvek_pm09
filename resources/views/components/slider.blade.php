@props(['count' => 4])

<div
    x-data="{
        current: 0,
        total: {{ (int) $count }},
        timer: null,
        start() {
            this.stop();
            this.timer = setInterval(() => this.next(), 3000);
        },
        stop() {
            if (this.timer !== null) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        go(index) {
            this.current = (index + this.total) % this.total;
            this.start();
        },
        next() {
            this.go(this.current + 1);
        },
        prev() {
            this.go(this.current - 1);
        },
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
>
    <div class="relative h-56 sm:h-72 lg:h-96 overflow-hidden rounded-lg">
        @for ($i = 0; $i < (int) $count; $i++)
            <div
                x-cloak
                x-show="current === {{ $i }}"
                x-transition.opacity
                class="absolute inset-0 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50"
            >
                <div class="px-6 text-center">
                    <p class="text-sm font-medium text-gray-500">Изображение {{ $i + 1 }} из {{ (int) $count }}</p>
                    <p class="mt-1 text-xs text-gray-400">Место под ссылку на изображение</p>
                </div>
            </div>
        @endfor

        <button
            type="button"
            @click="prev()"
            aria-label="Предыдущее изображение"
            class="absolute left-3 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-gray-700 shadow hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button
            type="button"
            @click="next()"
            aria-label="Следующее изображение"
            class="absolute right-3 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-gray-700 shadow hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <div class="mt-4 flex justify-center gap-2">
        @for ($i = 0; $i < (int) $count; $i++)
            <button
                type="button"
                @click="go({{ $i }})"
                aria-label="Изображение {{ $i + 1 }}"
                class="h-2.5 w-2.5 rounded-full transition"
                :class="current === {{ $i }} ? 'bg-indigo-600' : 'bg-gray-300'"
            ></button>
        @endfor
    </div>
</div>
