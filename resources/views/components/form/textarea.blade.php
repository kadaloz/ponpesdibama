@props([
    'id',
    'name',
    'label',
    'value' => '',
    'placeholder' => '',
    'rows' => 3,
    'required' => false,
])

<div class="mb-4">
    <label for="{{ $id }}" class="block text-sm font-semibold text-gray-700 mb-1">
        {{ $label }}
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500'
        ]) }}
    >{{ $value }}</textarea>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
