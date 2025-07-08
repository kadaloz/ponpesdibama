@props([
    'label',
    'name',
    'type' => 'text',
    'as' => 'input', // input, textarea, select
    'required' => false,
    'rows' => 3,
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-1">
        {{ $label }}{{ $required ? ' *' : '' }}
    </label>

    @if ($as === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500']) }}>{{ old($name) }}</textarea>
    @elseif ($as === 'select')
        <select name="{{ $name }}" id="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500']) }}>
            {{ $slot }}
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name) }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500']) }}>
    @endif

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
