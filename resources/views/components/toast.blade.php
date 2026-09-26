@props(['message'])

<div
    x-data="{ visible: true }"
    x-init="setTimeout(() => visible = false, 4000)"
    x-show="visible"
    x-cloak
    x-transition
    role="status"
    class="fixed right-4 top-4 z-50 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-lg"
>
    {{ $message }}
</div>
