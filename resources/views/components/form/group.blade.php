<div class="mb-4 {{ $attributes->get('class') }}">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-1">
        {{ $label }}
    </label>

    {{ $slot }}

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
