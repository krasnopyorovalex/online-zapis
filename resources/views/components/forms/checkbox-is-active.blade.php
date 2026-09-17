@props(['label' => 'Активна?', 'name'])

<label class="flex items-start gap-3 cursor-pointer select-none pt-1">
    <span class="group inline-flex items-center mt-0.5">
        <input type="checkbox" name="{{ $name }}" class="sr-only" checked />
        <span class="w-4 h-4 rounded border grid place-items-center transition-colors group-has-[input:checked]:bg-gray-900 group-has-[input:checked]:border-gray-900 group-focus-within:ring-2 group-focus-within:ring-gray-900/20">
            <svg class="w-3 h-3 text-white transition-opacity group-has-[input:checked]:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
        </span>
    </span>
    <span>
        <span class="block text-sm font-medium text-gray-700">{{ $label }}</span>
    </span>
</label>
