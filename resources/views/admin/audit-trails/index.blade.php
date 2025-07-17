@extends('layouts.admin')

@section('title', 'Log Audit Trail')
@section('header_admin', 'Audit Trail Sistem')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">

        {{-- Judul --}}
        <h3 class="text-2xl font-bold text-teal-700 mb-4 flex items-center">
            <x-heroicon-o-clipboard-document-list class="h-7 w-7 text-teal-600 mr-2" />
            Riwayat Aktivitas Pengguna
        </h3>

        {{-- Filter Form --}}
        <div class="mb-6 p-4 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('admin.audit-trails.index') }}" method="GET"
                  class="space-y-4 md:space-y-0 md:flex md:gap-4 items-end">
                
                {{-- Search --}}
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Aksi / Deskripsi / User:</label>
                    <input type="text" name="search" id="search" autocomplete="off"
                           placeholder="Contoh: login, create, admin"
                           class="flat-input mt-1 w-full" value="{{ request('search') }}">
                </div>

                {{-- User --}}
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700">Filter User:</label>
                    <select name="user" id="user" class="flat-select mt-1 w-full">
                        <option value="">Semua User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Aksi --}}
                <div>
                    <label for="action" class="block text-sm font-medium text-gray-700">Filter Aksi:</label>
                    <select name="action" id="action" class="flat-select mt-1 w-full">
                        <option value="">Semua Aksi</option>
                        @foreach ($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $action)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal:</label>
                    <input type="text" name="start_date" id="start_date" class="flatpickr mt-1 w-full"
                           value="{{ request('start_date') }}" placeholder="Pilih tanggal" autocomplete="off">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal:</label>
                    <input type="text" name="end_date" id="end_date" class="flatpickr mt-1 w-full"
                           value="{{ request('end_date') }}" placeholder="Pilih tanggal" autocomplete="off">
                </div>

                {{-- Tombol --}}
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary">
                        <x-heroicon-o-funnel class="h-4 w-4 mr-2" /> Filter
                    </button>
                    <a href="{{ route('admin.audit-trails.index') }}" class="btn-secondary">
                        <x-heroicon-o-arrow-path class="h-4 w-4 mr-2" /> Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Tabel Log --}}
        @if ($logs->isEmpty())
            <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border">Belum ada aktivitas.</p>
        @else
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-xs text-gray-600 uppercase font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">IP</th>
                            <th class="px-4 py-3 text-left">Browser</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        @foreach ($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 font-medium text-teal-700">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $log->description }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $log->user_id ? $log->user->name : 'Guest' }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $log->ip_address }}</td>
                                <td class="px-4 py-2 text-xs text-gray-500">{{ \Str::limit($log->user_agent, 50) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        @endif

        {{-- Purge Section --}}
        <div class="mt-10 p-6 bg-red-50 rounded-lg shadow-sm border border-red-200">
            <h4 class="font-bold text-xl text-red-700 mb-4 flex items-center">
                <x-heroicon-o-trash class="h-6 w-6 text-red-600 mr-2" /> Hapus Data Audit Trail Lama
            </h4>
            <form action="{{ route('admin.audit-trails.purge') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data audit trail yang lebih lama dari tanggal yang dipilih?');">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row items-end gap-4">
                    <div>
                        <label for="purge_date" class="block text-sm font-medium text-gray-700">Tanggal batas:</label>
                        <input type="text" name="purge_date" id="purge_date" required
                               class="flatpickr mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                               placeholder="Tanggal purge log" value="{{ old('purge_date') }}" autocomplete="off">
                    </div>
                    <button type="submit" class="btn-danger">
                        <x-heroicon-o-trash class="h-4 w-4 mr-2" /> Hapus Log
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
