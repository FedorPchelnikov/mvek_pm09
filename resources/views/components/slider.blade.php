@props(['images' => []])

<div
    x-data="{
        current: 0,
        total: {{ count($images) }},
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
    <div class="relative h-56 sm:h-72 lg:h-96 overflow-hidden rounded-lg bg-gray-100">
        @foreach ($images as $index => $image)
            <img
                x-cloak
                x-show="current === {{ $index }}"
                x-transition.opacity
                src="{{ asset($image['src']) }}"
                alt="{{ $image['alt'] }}"
                class="absolute inset-0 h-full w-full object-cover"
            >
        @endforeach

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

    <div class="mt-4 flex flex-wrap justify-center gap-2">
        @foreach ($images as $index => $image)
            <button
                type="button"
                @click="go({{ $index }})"
                aria-label="Показать: {{ $image['alt'] }}"
                class="h-2.5 w-2.5 rounded-full transition"
                :class="current === {{ $index }} ? 'bg-indigo-600' : 'bg-gray-300'"
            ></button>
        @endforeach
    </div>
</div>
