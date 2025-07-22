{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel Ponpes DIBAMA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Pastikan Alpine.js diimpor melalui app.js --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan ini di <head> layout -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen"> {{-- Menggunakan flexbox untuk layout utama --}}

    {{-- Container utama yang mengontrol layout sidebar dan konten --}}
    {{-- sidebarOpen: true untuk desktop (>= 768px), false untuk mobile secara default --}}
    <div x-data="{ sidebarOpen: window.innerWidth >= 768 ? true : false }"
         class="flex h-full w-full"> {{-- Menambahkan w-full untuk memastikan container mengambil seluruh lebar --}}

        {{-- Sidebar (Akan selalu fixed, visibilitas dikontrol oleh x-show) --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-teal-800 shadow-2xl flex flex-col">
            @include('admin.sidebar')
        </div>

        {{-- Overlay untuk Mobile (Hanya muncul jika sidebar terbuka di layar kecil) --}}
        <div x-show="sidebarOpen && window.innerWidth < 768"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black bg-opacity-50"
             @click="sidebarOpen = false"></div>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col transition-all duration-300"
             :class="{ 'ml-64': sidebarOpen && window.innerWidth >= 768 }"> {{-- Konten utama bergeser ke kanan saat sidebar terbuka di desktop --}}
            {{-- Admin Top Bar --}}
<header class="bg-white shadow-md p-4 flex justify-between items-center border-b border-gray-200 sticky top-0 z-30 px-6 py-4">
    {{-- Tombol Hamburger --}}
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-1 transition-colors duration-200">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <h1 class="text-2xl font-bold text-gray-800 ml-4 hidden md:block">@yield('header_admin')</h1>

    {{-- Foto Profil, Nama, dan Aksi --}}
    <div class="flex items-center space-x-4">
        {{-- Foto Profil --}}
        <img src="{{ Auth::user()->photo_path ? asset('storage/' . Auth::user()->photo_path) : asset('images/default-avatar.png') }}"
             alt="Foto Profil"
             class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">

        {{-- Sapaan --}}
        <span class="text-gray-700 font-medium text-sm hidden sm:block">
            {{ Auth::user()->name }}
        </span>

        {{-- Tombol Profil --}}
        @role('admin|sekret|mudabbir')
            <a href="{{ route('admin.profile.edit') }}"
               class="flex items-center text-xs px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil
            </a>
        @endrole

        {{-- Tombol Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex items-center text-xs px-3 py-1 rounded-md bg-red-500 hover:bg-red-600 text-white transition-colors duration-200">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</header>


            <div class="p-6 flex-1"> {{-- Area konten yang bisa di-scroll --}}
                @yield('admin_content')
            </div>
        </div>
    </div>

    @stack('scripts')
<script src="{{ asset('js/wilayah.js') }}"></script>
<!-- Tambahkan ini di akhir <body> layout -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


</body>
</html>
