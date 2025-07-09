<div class="mb-4">
    <label class="block font-medium text-gray-700 mb-2">{{ $label }}</label>
    <div class="flex flex-wrap gap-4">
        @foreach ($options as $value => $text)
            <label class="inline-flex items-center space-x-2">
                <input
                    type="radio"
                    name="{{ $name }}"
                    value="{{ $value }}"
                    @checked($checked === $value)
                    {{ $attributes->merge(['class' => 'text-teal-600 focus:ring-teal-500']) }}
                >
                <span>{{ $text }}</span>
            </label>
        @endforeach
    </div>
</div>
