<aside class="flex flex-col p-6 bg-gradient-to-b from-teal-800 to-teal-900 text-white shadow-xl h-full">
    <div class="text-center mb-10 pt-6 pb-4 border-b border-teal-700">
        <h2 class="text-2xl font-bold tracking-wide">Admin Panel</h2>
        <p class="text-teal-300 text-sm mt-1">PonpesDIBAMA.com</p>
    </div>

    <nav class="flex-1 overflow-y-auto custom-scrollbar">
        <ul class="space-y-2">
            @can('view dashboard')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.dashboard') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                    <x-heroicon-o-home class="w-5 h-5 mr-2" /> Dashboard
                    </a>
                </li>
            @endcan

            <li class="mt-6 pt-4 border-t border-teal-700">
                <p class="text-xs uppercase text-teal-300 font-semibold mb-2 px-4">Konten & Website</p>
            </li>

            @can('view news')
                <li>
                    <a href="{{ route('admin.news.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.news.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-newspaper class="w-5 h-5 mr-2" /> Berita & Pengumuman
                    </a>
                </li>
            @endcan

            @can('manage settings')
                <li>
                    <a href="{{ route('admin.settings.edit') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.settings.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-cog class="w-5 h-5 mr-2" /> Pengaturan Website
                    </a>
                </li>
            @endcan

            @can('view galleries')
                <li>
                    <a href="{{ route('admin.galleries.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.galleries.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-photo class="w-5 h-5 mr-2" /> Manajemen Galeri
                    </a>
                </li>
            @endcan

            <li class="mt-6 pt-4 border-t border-teal-700">
                <p class="text-xs uppercase text-teal-300 font-semibold mb-2 px-4">Santri & PPDB</p>
            </li>

            @can('view students')
                <li>
                    <a href="{{ route('admin.students.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.students.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-identification class="w-5 h-5 mr-2" /> Data Santri
                    </a>
                </li>
            @endcan

            @can('view applicants')
                <li>
                    <a href="{{ route('admin.applicants.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.applicants.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-clipboard-document class="w-5 h-5 mr-2" /> Pendaftaran PPDB
                    </a>
                </li>
            @endcan

            @can('edit ppdb requirements')
                <li>
                    <a href="{{ route('admin.ppdb-requirements.edit') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('ppdb_requirements.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-document-text class="w-5 h-5 mr-2" /> Syarat Pendaftaran
                    </a>
                </li>
            @endcan

            <li class="mt-6 pt-4 border-t border-teal-700">
                <p class="text-xs uppercase text-teal-300 font-semibold mb-2 px-4">Administrasi Sistem</p>
            </li>

            @can('view programs')
                <li>
                    <a href="{{ route('admin.programs.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.programs.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-check-circle class="w-5 h-5 mr-2" /> Manajemen Program
                    </a>
                </li>
            @endcan
            @can('view halaqohs')
                <li>
                    <a href="{{ route('admin.halaqohs.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.halaqohs.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-book-open class="w-5 h-5 mr-2" /> Manajemen Halaqoh
                    </a>
                </li>
            @endcan

            @can('manage users')
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.users.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-user class="w-5 h-5 mr-2" /> Akun Pengguna
                    </a>
                </li>
            @endcan

            @can('assign roles')
                <li>
                    <a href="{{ route('admin.permissions.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.permissions.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-lock-closed class="w-5 h-5 mr-2" /> Peran & Izin
                    </a>
                </li>
            @endcan

            @can('view teachers')
                <li>
                    <a href="{{ route('admin.teachers.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.teachers.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" /> Manajemen Pengajar
                    </a>
                </li>
            @endcan

            <li class="mt-6 pt-4 border-t border-teal-700">
                <p class="text-xs uppercase text-teal-300 font-semibold mb-2 px-4">Modul Lain</p>
            </li>

            @can('view general management')
                <li>
                    <a href="{{ route('admin.general.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md {{ request()->routeIs('admin.general.*') ? 'bg-teal-700 text-white shadow-md' : 'text-teal-100' }}">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5 mr-2" /> Manajemen Umum
                    </a>
                </li>
            @endcan

            @can('manage finance')
                <li>
                    <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md text-teal-100">
                        <x-heroicon-o-currency-dollar class="w-5 h-5 mr-2" /> Keuangan
                    </a>
                </li>
            @endcan

            @can('manage dormitories')
                <li>
                    <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md text-teal-100">
                        <x-heroicon-o-home class="w-5 h-5 mr-2" /> Asrama
                    </a>
                </li>
            @endcan

            @can('manage events')
                <li>
                    <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-teal-700 hover:shadow-md text-teal-100">
                        <x-heroicon-o-calendar class="w-5 h-5 mr-2" /> Event
                    </a>
                </li>
            @endcan
        </ul>
    </nav>

    <div class="mt-auto pt-4 text-xs text-teal-300 text-center border-t border-teal-700">
        <p>&copy; {{ date('Y') }} PonpesDIBAMA.com</p>
        <p>Admin Panel v1.0</p>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="flex items-center justify-center w-full px-4 py-2 mt-1 text-sm font-medium transition-colors duration-200 bg-teal-700 rounded hover:bg-teal-600">
                <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-2" /> Logout
            </button>
        </form>
    </div>
</aside>
