@props(['label', 'name', 'required' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-1">
        {{ $label }}{{ $required ? ' *' : '' }}
    </label>
    <select name="{{ $name }}" id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500']) }}>
        {{ $slot }}
    </select>
    @error($name)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>
