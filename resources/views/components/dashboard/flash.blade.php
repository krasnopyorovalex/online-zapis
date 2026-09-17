@props(['type' => 'success'])

@php
    $styles = [
        'success' => [
            'wrap'  => 'bg-emerald-50 border-emerald-200 text-emerald-800',
            'icon'  => 'text-emerald-500',
            'bar'   => 'bg-emerald-500',
            'path'  => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        'error' => [
            'wrap'  => 'bg-red-50 border-red-200 text-red-800',
            'icon'  => 'text-red-500',
            'bar'   => 'bg-red-500',
            'path'  => 'M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        'warning' => [
            'wrap'  => 'bg-amber-50 border-amber-200 text-amber-800',
            'icon'  => 'text-amber-500',
            'bar'   => 'bg-amber-500',
            'path'  => 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z',
        ],
        'info' => [
            'wrap'  => 'bg-sky-50 border-sky-200 text-sky-800',
            'icon'  => 'text-sky-500',
            'bar'   => 'bg-sky-500',
            'path'  => 'M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z',
        ],
    ];

    $s = $styles[$type] ?? $styles['info'];
@endphp

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="relative overflow-hidden flex items-start gap-3 rounded-lg border px-4 py-3 pr-10 text-sm shadow-sm {{ $s['wrap'] }}"
    style="display:none"
    role="alert"
>
    {{-- Цветная полоска слева --}}
    <span class="absolute inset-y-0 left-0 w-1 {{ $s['bar'] }}"></span>

    {{-- Иконка --}}
    <svg class="w-5 h-5 shrink-0 mt-0.5 {{ $s['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['path'] }}"/>
    </svg>

    {{-- Текст --}}
    <div class="flex-1 leading-relaxed">
        {{ $slot }}
    </div>

    {{-- Кнопка закрытия --}}
    <button @click="show = false" class="absolute top-2.5 right-2.5 p-1 rounded-md opacity-60 hover:opacity-100 hover:bg-black/5 transition" aria-label="Закрыть">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M6 18L18 6"/>
        </svg>
    </button>
</div>
