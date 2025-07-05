@props(['program'])

<div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-teal-100 h-full flex flex-col justify-between">
    <div>
        <h3 class="text-xl md:text-2xl font-bold text-teal-700 mb-4 leading-snug">{{ $program->name }}</h3>
        <p class="text-gray-600 text-base leading-relaxed mb-4">
            {{ Str::limit(strip_tags($program->description), 150) }}
        </p>
        <p class="text-sm text-gray-500 italic mb-6">Durasi: {{ $program->duration ?? '-' }}</p>
    </div>

    <a href="{{ route('programs.show', $program->slug) }}"
       class="inline-flex items-center text-teal-600 hover:text-teal-800 font-medium transition group">
        Detail Program
        <svg class="w-4 h-4 ml-2 transition-transform duration-200 transform group-hover:translate-x-1"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    </a>
</div>
