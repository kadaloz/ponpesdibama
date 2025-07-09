@props([
    'id',
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'inputmode' => null,
    'note' => null,
])

<div class="mb-4">
    <label for="{{ $id }}" class="block text-sm font-semibold text-gray-700 mb-1">
        {{ $label }}
        @if ($note)
            <span class="text-gray-400 italic">{{ $note }}</span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $inputmode ? "inputmode=$inputmode" : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500'
        ]) }}
    >
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
