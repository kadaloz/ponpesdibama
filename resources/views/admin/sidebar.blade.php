<aside class="flex flex-col p-6 bg-gradient-to-b from-teal-800 to-teal-900 text-white shadow-xl h-full">

    {{-- Header --}}
    <div class="text-center mb-10 pt-6 pb-4 border-b border-teal-700">
        <h2 class="text-2xl font-bold tracking-wide">Admin Panel</h2>
        <p class="text-teal-300 text-sm mt-1">PonpesDIBAMA.com</p>
    </div>

    {{-- Profil User --}}
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo"
             class="w-16 h-16 rounded-full shadow-lg">
        <div class="ml-4">
            <h3 class="text-lg font-semibold">{{ auth()->user()->name }}</h3>
            <p class="text-sm text-teal-300">{{ auth()->user()->email }}</p>
        </div>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-1 overflow-y-auto custom-scrollbar">
        <ul class="space-y-2">

            {{-- Dashboard --}}
            @can('view dashboard')
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md
                              {{ request()->routeIs('admin.dashboard') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-home class="w-5 h-5 mr-2" />
                        Dashboard
                    </a>
                </li>
            @endcan

            {{-- Santri & PPDB --}}
            @canany(['view students', 'view applicants', 'edit ppdb requirements'])
                <x-sidebar.section title="Santri & PPDB" />
            @endcanany

            @can('view students')
                <x-sidebar.link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                    <x-heroicon-o-identification class="w-5 h-5 mr-2" />
                    Data Santri
                </x-sidebar.link>
            @endcan

            @can('view applicants')
                <x-sidebar.link :href="route('admin.applicants.index')" :active="request()->routeIs('admin.applicants.*')">
                    <x-heroicon-o-clipboard-document class="w-5 h-5 mr-2" />
                    Pendaftaran PPDB
                </x-sidebar.link>
            @endcan

            @can('edit ppdb requirements')
                <x-sidebar.link :href="route('admin.ppdb-requirements.edit')" :active="request()->routeIs('admin.ppdb-requirements.*')">
                    <x-heroicon-o-document-text class="w-5 h-5 mr-2" />
                    Syarat Pendaftaran
                </x-sidebar.link>
            @endcan

            {{-- Asrama & Penempatan --}}
            @canany(['view placements', 'view rooms'])
                <x-sidebar.section title="Asrama & Penempatan" />
                @include('components.sidebar.dormitory-management')
            @endcanany

            {{-- Konten & Website --}}
            @canany(['view news', 'view galleries'])
                <x-sidebar.section title="Konten & Website" />
            @endcanany

            @can('view news')
                <x-sidebar.link :href="route('admin.news.index')" :active="request()->routeIs('admin.news.*')">
                    <x-heroicon-o-newspaper class="w-5 h-5 mr-2" />
                    Berita & Pengumuman
                </x-sidebar.link>
            @endcan

            @can('view galleries')
                <x-sidebar.link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')">
                    <x-heroicon-o-photo class="w-5 h-5 mr-2" />
                    Manajemen Galeri
                </x-sidebar.link>
            @endcan

            {{-- Administrasi & Data Master --}}
            @canany(['view teachers', 'view programs', 'view halaqohs'])
                <x-sidebar.section title="Administrasi & Data Master" />
            @endcanany

            @can('view teachers')
                <x-sidebar.link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                    <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                    Manajemen Pengajar
                </x-sidebar.link>
            @endcan

            @can('view programs')
                <x-sidebar.link :href="route('admin.programs.index')" :active="request()->routeIs('admin.programs.*')">
                    <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
                    Manajemen Program
                </x-sidebar.link>
            @endcan

            @can('view halaqohs')
                <x-sidebar.link :href="route('admin.halaqohs.index')" :active="request()->routeIs('admin.halaqohs.*')">
                    <x-heroicon-o-book-open class="w-5 h-5 mr-2" />
                    Manajemen Halaqoh
                </x-sidebar.link>
            @endcan

            {{-- Pengaturan Sistem --}}
            @canany(['manage users', 'assign roles', 'manage settings', 'view audit logs'])
                <x-sidebar.section title="Pengaturan Sistem" />
            @endcanany

            @can('manage users')
                <x-sidebar.link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    <x-heroicon-o-user class="w-5 h-5 mr-2" />
                    Akun Pengguna
                </x-sidebar.link>
            @endcan

            @can('assign roles')
                <x-sidebar.link :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.*')">
                    <x-heroicon-o-lock-closed class="w-5 h-5 mr-2" />
                    Peran & Izin
                </x-sidebar.link>
            @endcan

            @can('manage settings')
                <x-sidebar.link :href="route('admin.settings.edit')" :active="request()->routeIs('admin.settings.*')">
                    <x-heroicon-o-cog class="w-5 h-5 mr-2" />
                    Pengaturan Website
                </x-sidebar.link>
            @endcan

            @can('view audit logs')
                <x-sidebar.link :href="route('admin.audit-trails.index')" :active="request()->routeIs('admin.audit-trails.*')">
                    <x-heroicon-o-document-text class="w-5 h-5 mr-2" />
                    Audit Trail
                </x-sidebar.link>
            @endcan

        </ul>
    </nav>

    {{-- Footer --}}
    <div class="mt-auto pt-4 text-xs text-teal-300 text-center border-t border-teal-700">
        <p>&copy; {{ date('Y') }} PonpesDIBAMA.com</p>
        <p>Admin Panel v1.0</p>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit"
                    class="flex items-center justify-center w-full px-4 py-2 mt-1 text-sm font-medium transition-colors duration-200 bg-teal-700 rounded hover:bg-teal-600">
                <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-2" />
                Logout
            </button>
        </form>
    </div>
</aside>
