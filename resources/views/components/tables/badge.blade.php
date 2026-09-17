@props(['color' => 'gray', 'dot' => true])

@php
    $colors = [
        'gray'    => 'bg-gray-100 text-gray-700 ring-gray-200 bg-gray-400',
        'success' => 'bg-emerald-50 text-emerald-700 ring-emerald-200 bg-emerald-500',
        'warning' => 'bg-amber-50 text-amber-700 ring-amber-200 bg-amber-500',
        'danger'  => 'bg-red-50 text-red-700 ring-red-200 bg-red-500',
        'info'    => 'bg-sky-50 text-sky-700 ring-sky-200 bg-sky-500',
    ];
    $c = $colors[$color] ?? $colors['gray'];
    [$bg, $text, $ring, $dotColor] = explode(' ', $c);
@endphp

<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $bg }} {{ $text }} {{ $ring }}">
    @if ($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
    @endif
    {{ $slot }}
</span>
