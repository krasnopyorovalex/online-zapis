@props(['name', 'label' => '', 'required' => true, 'type' => 'text'])

<div>
    <label for="company-{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
    </label>
    <input id="company-{{ $name }}" type="{{ $type }}" autocomplete="off" {{ $attributes }}
    class="w-full px-3 py-2 text-sm rounded-lg border bg-white placeholder:text-gray-400 focus:outline-0
                       @error($name) border-red-400 focus:ring-red-500/10 @enderror"
    >
    @error($name)
    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
