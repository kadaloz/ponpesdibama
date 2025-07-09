@props([
    'id' => null,
    'name',
    'label' => '',
    'accept' => '',
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

    <input
        type="file"
        id="{{ $id }}"
        name="{{ $name }}"
        accept="{{ $accept }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->except('class')->merge([
            'class' => 'block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100'
        ]) }}
    />

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
