{{-- resources/views/web/header.blade.php --}}
<header class="bg-teal-700 text-white p-4 shadow-lg rounded-b-lg sticky top-0 z-50 h-20 flex items-center">
    <div class="container mx-auto flex justify-between items-center px-4">
        <!-- Logo atau Nama Pondok -->
        <a href="{{ url('/') }}" class="text-3xl font-bold rounded-md p-2 hover:bg-teal-600 transition-colors">
            PonpesDIBAMA<span class="text-xl text-yellow-200">.com</span>
        </a>

        <!-- Logo Kecil Kanan -->
        <div class="flex space-x-3 items-center">
            <img src="https://picsum.photos/seed/logo1/40/40" alt="Logo 1" class="h-8 w-8 rounded-md shadow-sm hover:scale-105 transition-transform">
            <img src="https://picsum.photos/seed/logo2/40/40" alt="Logo 2" class="h-8 w-8 rounded-md shadow-sm hover:scale-105 transition-transform">
            <img src="https://picsum.photos/seed/logo3/40/40" alt="Logo 3" class="h-8 w-8 rounded-md shadow-sm hover:scale-105 transition-transform">
        </div>
    </div>
</header>
