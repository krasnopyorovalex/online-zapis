@props([
    'variant' => 'default', // default | danger
    'label'   => null,      // для a11y
    'tag'     => 'button',  // button | a
])

@php
    $styles = [
        'default' => 'text-gray-400 hover:text-gray-700 hover:bg-gray-100 hover:cursor-pointer',
        'danger'  => 'text-gray-400 hover:text-red-600 hover:bg-red-50 hover:cursor-pointer',
    ];
    $class = $styles[$variant] ?? $styles['default'];
@endphp

@if ($tag === 'a')
    <a {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center w-8 h-8 rounded-md transition-colors $class",
        'aria-label' => $label,
        'title' => $label,
    ]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge([
        'type' => 'button',
        'class' => "inline-flex items-center justify-center w-8 h-8 rounded-md transition-colors $class",
        'aria-label' => $label,
        'title' => $label,
    ]) }}>
        {{ $slot }}
    </button>
@endif
