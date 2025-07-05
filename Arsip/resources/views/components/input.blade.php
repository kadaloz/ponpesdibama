@props([
    'id' => null,
    'type' => 'text',
    'name',
    'label' => null,
    'value' => '',
    'required' => false,
])

@php
    $id = $id ?? $name;
@endphp

<div>
  @if($label)
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
      {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
  @endif

  <input
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500']) }}
  >

  @error($name)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>
