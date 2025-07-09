@props([
    'id' => null,
    'name',
    'label' => '',
    'options' => [],
    'selected' => '',
    'placeholder' => '',
    'required' => false,
])

@php
    $id = $id ?? $name;
@endphp

<div class="mb-4 {{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-semibold text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <select
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->except('class')->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500'
        ]) }}
    >
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $optionValue => $optionText)
            <option value="{{ $optionValue }}" {{ $optionValue == $selected ? 'selected' : '' }}>
                {{ $optionText }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
