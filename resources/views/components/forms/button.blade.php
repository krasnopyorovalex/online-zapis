@props([
    'variant' => 'primary',  // primary | ghost | danger
    'type'    => 'button',
    'icon'    => null,
])

@php
    $styles = [
        'primary' => 'bg-white text-gray-900 hover:bg-gray-800 hover:text-white active:bg-gray-950 shadow-sm',
        'ghost'   => 'text-gray-700 hover:bg-gray-100',
        'danger'  => 'bg-red-600 text-white hover:bg-red-700 active:bg-red-800 shadow-sm',
    ];
    $class = $styles[$variant] ?? $styles['primary'];
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-medium hover:cursor-pointer
                    transition-colors disabled:opacity-50 disabled:cursor-not-allowed $class",
    ]) }}
>
    @if ($icon)
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}"/>
        </svg>
    @endif
    {{ $slot }}
</button>
