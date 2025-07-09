@props([
    'id',
    'name',
    'label',
    'options' => [],
    'selected' => '',
    'placeholder' => '',
    'required' => false,
])

<div class="mb-4 {{ $attributes->get('class') }}">
    <label for="{{ $id }}" class="block text-sm font-semibold text-gray-700 mb-1">
        {{ $label }}
    </label>
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
    >
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
