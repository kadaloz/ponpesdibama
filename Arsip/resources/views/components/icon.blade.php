@props(['name', 'class' => 'w-5 h-5'])

@php
    $icons = [
        'arrow-left' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>',
        'edit' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2M15.232 5.232l3.536 3.536M4 13v6h6l10-10-6-6L4 13z" /></svg>',
        'trash' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
        'plus' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>',
        'check' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',
        'view-grid' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18a2 2 0 012 2v14a2 2 0 01-2 2H3a2 2 0 01-2-2V5a2 2 0 012-2zM9 9h6M9 15h6M9 12h6" /></svg>',
        'o-view-grid' => '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>',
    ];
@endphp

{!! $icons[$name] ?? '<!-- Icon not found -->' !!}
