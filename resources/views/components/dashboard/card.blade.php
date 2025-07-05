@props([
    'route',
    'title',
    'color' => 'teal'
])

@php
$bg = "bg-{$color}-100";
$text = "text-{$color}-600";
$button = "bg-{$color}-500 hover:bg-{$color}-600";
@endphp

<div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl border {{ $bg }}">
    <div class="{{ $bg }} rounded-full p-4 mb-4 {{ $text }} shadow-md">
        {{ $icon ?? '' }}
    </div>
    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $slot }}</p>
    <a href="{{ route($route) }}" class="mt-auto px-5 py-2 {{ $button }} text-white rounded-full transition-colors shadow-md">
        Kelola
    </a>
</div>
