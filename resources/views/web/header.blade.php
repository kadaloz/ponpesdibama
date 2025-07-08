{{-- resources/views/web/header.blade.php --}}
<header class="bg-teal-700 text-white p-4 shadow-lg rounded-b-lg sticky top-0 z-50 h-20 flex items-center">
    <div class="container mx-auto flex justify-between items-center px-4">
        <!-- Logo atau Nama Pondok -->
        <a href="{{ url('/') }}" class="text-3xl font-bold rounded-md p-2 hover:bg-teal-600 transition-colors">PonpesDIBAMA<span class="text-xl text-yellow-200">.com</span></a>
        {{-- Tautan navigasi sekarang ditangani di home.blade.php untuk smooth scrolling --}}
    </div>
</header>
