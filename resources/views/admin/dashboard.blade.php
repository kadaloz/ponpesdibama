@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_admin', 'Dashboard Ponpes DIBAMA')

@section('admin_content')
<div class="bg-white shadow sm:rounded-lg">
    <div class="p-8 text-gray-900">
        <h1 class="text-3xl font-bold text-teal-700 mb-6">Selamat Datang, {{ Auth::user()?->name }}!</h1>
        <p class="text-gray-600 text-base mb-8">
            Silakan pilih modul untuk mengelola berbagai aspek penting website Ponpes DIBAMA.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @can('view news')
                <x-dashboard.card route="admin.news.index" title="Berita & Pengumuman" color="teal">
                    <x-slot name="icon">
                        <x-heroicon-o-newspaper class="w-12 h-12" />
                    </x-slot>
                    Kelola berita, pengumuman, dan artikel terbaru pondok.
                </x-dashboard.card>
            @endcan

            @can('view applicants')
                <x-dashboard.card route="admin.applicants.index" title="Manajemen Pendaftaran" color="yellow">
                    <x-slot name="icon">
                        <x-heroicon-o-user-plus class="w-12 h-12" />
                    </x-slot>
                    Kelola data calon santri PSB.
                </x-dashboard.card>
            @endcan

            @can('view students')
                <x-dashboard.card route="admin.students.index" title="Data Santri" color="blue">
                    <x-slot name="icon">
                        <x-heroicon-o-identification class="w-12 h-12" />
                    </x-slot>
                    Kelola data lengkap santri aktif dan alumni.
                </x-dashboard.card>
            @endcan

            @can('manage settings')
                <x-dashboard.card route="admin.settings.edit" title="Pengaturan Website" color="purple">
                    <x-slot name="icon">
                        <x-heroicon-o-cog-6-tooth class="w-12 h-12" />
                    </x-slot>
                    Kelola konten statis, informasi kontak, dan lainnya.
                </x-dashboard.card>
            @endcan

            @can('view programs')
                <x-dashboard.card route="admin.programs.index" title="Manajemen Program" color="lime">
                    <x-slot name="icon">
                        <x-heroicon-o-check-circle class="w-12 h-12" />
                    </x-slot>
                    Kelola daftar program pendidikan Ponpes.
                </x-dashboard.card>
            @endcan

            @canany(['view students', 'view reports'])
                <x-dashboard.statistik title="Statistik Santri" color="green">
                    <x-slot name="icon">
                        <x-heroicon-o-chart-pie class="w-12 h-12" />
                    </x-slot>
                    <p class="text-sm font-semibold">Total: <span class="text-teal-700">{{ $totalStudents ?? 0 }}</span></p>
                    <p class="text-sm font-semibold">Aktif: <span class="text-green-700">{{ $totalActiveStudents ?? 0 }}</span></p>
                    <p class="text-sm font-semibold">Lulus: <span class="text-blue-700">{{ $totalGraduatedStudents ?? 0 }}</span></p>
                </x-dashboard.statistik>
            @endcan

            @can('view general management')
                <x-dashboard.card route="admin.general.dashboard" title="Manajemen Umum" color="indigo">
                    <x-slot name="icon">
                        <x-heroicon-o-home class="w-12 h-12" />
                    </x-slot>
                    Akses pendaftaran, keuangan, pengajar, asrama, laporan, dan event.
                </x-dashboard.card>
            @endcan

            @can('view news')
                <x-dashboard.statistik title="Statistik Berita" color="orange">
                    <x-slot name="icon">
                        <x-heroicon-o-document-text class="w-12 h-12" />
                    </x-slot>
                    <p class="text-sm font-semibold">Total Berita: <span class="text-teal-700">{{ $totalNews ?? 0 }}</span></p>
                </x-dashboard.statistik>
            @endcan

            @can('view applicants')
                <x-dashboard.statistik title="Statistik Pendaftaran" color="yellow">
                    <x-slot name="icon">
                        <x-heroicon-o-clipboard-document class="w-12 h-12" />
                    </x-slot>
                    <p class="text-sm font-semibold">Total: <span class="text-teal-700">{{ $totalApplicants ?? 0 }}</span></p>
                    <p class="text-sm font-semibold">Menunggu: <span class="text-orange-700">{{ $pendingApplicants ?? 0 }}</span></p>
                    <p class="text-sm font-semibold">Diterima: <span class="text-green-700">{{ $acceptedApplicants ?? 0 }}</span></p>
                </x-dashboard.statistik>
            @endcan

            @can('manage users')
                <x-dashboard.statistik title="Pengguna Aktif" color="cyan">
                    <x-slot name="icon">
                        <x-heroicon-o-users class="w-12 h-12" />
                    </x-slot>
                    <p class="text-sm font-semibold">Total: <span class="text-teal-700">{{ App\Models\User::count() }}</span></p>
                    <p class="text-sm font-semibold">Admin: <span class="text-green-700">{{ App\Models\User::role('admin')->count() }}</span></p>
                    <p class="text-sm font-semibold">Sekretaris: <span class="text-blue-700">{{ App\Models\User::role('sekret')->count() }}</span></p>
                    <p class="text-sm font-semibold">Mudabbir: <span class="text-purple-700">{{ App\Models\User::role('mudabbir')->count() }}</span></p>
                </x-dashboard.statistik>
            @endcan
        </div>
    </div>
</div>
@endsection
