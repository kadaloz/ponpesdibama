@props([
    'name',
    'label',
    'options' => [],
    'checked' => '',
    'onchange' => null,
])

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ $label }}</label>
    <div class="space-x-4">
        @foreach ($options as $value => $text)
            <label>
                <input
                    type="radio"
                    name="{{ $name }}"
                    value="{{ $value }}"
                    {{ $value == $checked ? 'checked' : '' }}
                    {{ $onchange ? "onchange=$onchange" : '' }}
                > {{ $text }}
            </label>
        @endforeach
    </div>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
