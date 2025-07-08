@props([
    'title',
    'icon' => null,
    'color' => 'blue', // blue, yellow, green, red
    'accordion' => false,
])

@php
    $colors = [
        'blue' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-400', 'text' => 'text-blue-700', 'icon' => 'text-blue-500'],
        'yellow' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-400', 'text' => 'text-yellow-700', 'icon' => 'text-yellow-500'],
        'green' => ['bg' => 'bg-green-50', 'border' => 'border-green-400', 'text' => 'text-green-700', 'icon' => 'text-green-500'],
        'red' => ['bg' => 'bg-red-50', 'border' => 'border-red-400', 'text' => 'text-red-700', 'icon' => 'text-red-500'],
    ];
    $c = $colors[$color] ?? $colors['blue'];
@endphp

<div x-data="{ open: {{ $accordion ? 'false' : 'true' }} }" class="{{ $c['bg'] }} border-l-4 {{ $c['border'] }} p-6 rounded-xl shadow" x-cloak>
    <div class="flex justify-between items-center {{ $accordion ? 'cursor-pointer' : '' }}" @if($accordion) @click="open = !open" @endif>
        <div class="flex items-center">
            @if ($icon)
                <x-dynamic-component :component="$icon" class="w-6 h-6 {{ $c['icon'] }} mr-2" />
            @else
                <svg class="w-6 h-6 {{ $c['icon'] }} mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            @endif
            <h3 class="text-lg font-bold {{ $c['text'] }}">{{ $title }}</h3>
        </div>

        @if ($accordion)
            <svg x-show="!open" class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <svg x-show="open" class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        @endif
    </div>

    <div x-show="open" class="mt-4 text-sm text-gray-700 transition-all duration-300 ease-in-out">
        {{ $slot }}
    </div>
</div>
