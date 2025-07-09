@props([
    'id',
    'name',
    'label',
    'accept' => '',
])

<div>
    <label for="{{ $id }}" class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}</label>
    <input
        type="file"
        name="{{ $name }}"
        id="{{ $id }}"
        accept="{{ $accept }}"
        class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border-0 file:rounded-md file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
    >
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
