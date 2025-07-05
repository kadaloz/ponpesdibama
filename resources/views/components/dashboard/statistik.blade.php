@props([
    'title',
    'color' => 'gray'
])

@php
$bg = "bg-{$color}-100";
$text = "text-{$color}-600";
@endphp

<div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl border {{ $bg }}">
    <div class="{{ $bg }} rounded-full p-4 mb-4 {{ $text }} shadow-md">
        {{ $icon ?? '' }}
    </div>
    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $title }}</h3>
    <div class="text-left text-gray-700 w-full mb-4">
        {{ $slot }}
    </div>
</div>
