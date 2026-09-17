@props(['name'])

<input type="file" name="{{ $name }}" {{ $attributes }} />

<div>
    @error($name) <span class="error">{{ $message }}</span> @enderror
</div>
