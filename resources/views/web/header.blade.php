<header class="bg-teal-700 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-4 py-3 md:py-4">
        <!-- Logo Utama -->
        <a href="{{ url('/') }}" class="text-2xl md:text-3xl font-bold tracking-tight hover:opacity-90 transition">
            PonpesDIBAMA<span class="text-yellow-300">.com</span>
        </a>

        <!-- Logo Institusi Resmi (Hanya tampil di desktop) -->
        <div class="hidden md:flex items-center space-x-3">
            <img src="{{ asset('images/logo/kemenag.png') }}" 
                 alt="Logo Kemenag" title="Kementerian Agama RI" 
                 class="h-8 w-8 rounded-md shadow-sm hover:scale-105 transition-transform duration-200 ease-in-out">

            <img src="{{ asset('images/logo/nasional.png') }}" 
                 alt="Logo Nasional" title="Lambang Negara Indonesia" 
                 class="h-8 w-8 rounded-md shadow-sm hover:scale-105 transition-transform duration-200 ease-in-out">

            <img src="{{ asset('images/logo/ponpes.png') }}" 
                 alt="Logo Pesantren" title="Logo Resmi Pondok Pesantren" 
                 class="h-8 w-8 rounded-md shadow-sm hover:scale-105 transition-transform duration-200 ease-in-out">
        </div>
    </div>
</header>
