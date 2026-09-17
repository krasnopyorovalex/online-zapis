@props([
    'name',
    'title'       => null,
    'maxWidth'    => 'md',
    'dismissible' => true,     // клик по backdrop закрывает
    'closeOnEsc'  => true,     // Esc закрывает
])

@php
    $widths = [
        'sm' => 'max-w-sm', 'md' => 'max-w-md', 'lg' => 'max-w-lg',
        'xl' => 'max-w-xl', '2xl' => 'max-w-2xl',
    ];
    $w = $widths[$maxWidth] ?? $widths['md'];
@endphp

<div
    x-data="{ show: false }"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') show = true"
    x-on:close-modal.window="if ($event.detail.name === '{{ $name }}') show = false"
    @if ($closeOnEsc)
        x-on:keydown.escape.window="show = false"
    @endif
    x-show="show"
    x-cloak
    class="fixed inset-0 z-70 flex items-center justify-center p-4 sm:p-6"
    style="display:none"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @if ($dismissible)
            @click="show = false; $dispatch('close-modal', { name: '{{ $name }}' })"
        @endif
        class="absolute inset-0 bg-gray-900/40 backdrop-blur-[2px]"
    ></div>

    {{-- Panel --}}
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-2 scale-[0.98]"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-[0.98]"
        @click.stop
        class="relative w-full {{ $w }} bg-white rounded-xl border border-gray-200 shadow-xl overflow-hidden"
    >
        {{-- Header --}}
        @if ($title)
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="text-base font-semibold tracking-tight text-gray-900">{{ $title }}</h2>

                <button type="button" @click="show = false; $dispatch('close-modal', { name: '{{ $name }}' })" class="inline-flex items-center justify-center w-8 h-8 rounded-md
                               text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors hover:cursor-pointer"
                    aria-label="Закрыть"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <div class="px-5 py-5">{{ $slot }}</div>

        @isset($footer)
            <div class="px-5 py-3.5 bg-gray-50/60 border-t border-gray-100 flex items-center justify-end gap-2">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
