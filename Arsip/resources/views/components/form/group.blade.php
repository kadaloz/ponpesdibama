@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'icon' => null,
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        @if($icon)
            <x-dynamic-component :component="'heroicon-o.' . $icon" class="w-4 h-4 inline mr-1 text-teal-500" />
        @endif
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm']) }}
    >
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
