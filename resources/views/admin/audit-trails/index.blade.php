@extends('layouts.admin')

@section('title', 'Log Audit Trail')
@section('header_admin', 'Audit Trail Sistem')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold text-teal-700 mb-4 flex items-center">
            <x-heroicon-o-clipboard-document-list class="h-7 w-7 text-teal-600 mr-2" />
            Riwayat Aktivitas Pengguna
        </h3>

        {{-- Filter and Search Section --}}
        <div class="mb-6 p-4 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('admin.audit-trails.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:gap-4 items-end">
                {{-- Search Input --}}
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Aksi / Deskripsi / User:</label>
                    <input type="text" name="search" id="search" placeholder="Contoh: login, create, admin"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                           value="{{ request('search') }}">
                </div>

                {{-- Filter by User --}}
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700">Filter User:</label>
                    <select name="user" id="user"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        <option value="">Semua User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter by Action --}}
                <div>
                    <label for="action" class="block text-sm font-medium text-gray-700">Filter Aksi:</label>
                    <select name="action" id="action"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        <option value="">Semua Aksi</option>
                        @foreach ($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $action)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date Range Filter --}}
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal:</label>
                    <input type="date" name="start_date" id="start_date"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                           value="{{ request('start_date') }}">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal:</label>
                    <input type="date" name="end_date" id="end_date"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                           value="{{ request('end_date') }}">
                </div>

                {{-- Submit Button --}}
                <div class="flex gap-2">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <x-heroicon-o-funnel class="h-4 w-4 mr-2" />
                        Filter
                    </button>
                    <a href="{{ route('admin.audit-trails.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <x-heroicon-o-arrow-path class="h-4 w-4 mr-2" />
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if ($logs->isEmpty())
            <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                Belum ada aktivitas yang tercatat dengan kriteria yang dipilih.
            </p>
        @else
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User ID</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IP</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Browser</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 text-sm text-gray-700">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-2 px-4 text-sm font-medium text-teal-700">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</td>
                                <td class="py-2 px-4 text-sm text-gray-800">{{ $log->description }}</td>
                                <td class="py-2 px-4 text-sm text-gray-700">
                                    {{ $log->user_id ? $log->user->name : 'Guest' }}
                                </td>
                                <td class="py-2 px-4 text-sm text-gray-700">{{ $log->user_name ?? 'Guest' }}</td> {{-- Asumsi ada relasi user --}}
                                <td class="py-2 px-4 text-sm text-gray-600">{{ $log->ip_address }}</td>
                                <td class="py-2 px-4 text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($log->user_agent, 50) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        @endif

        {{-- Section for Purging Old Data --}}
        <div class="mt-10 p-6 bg-red-50 rounded-lg shadow-sm border border-red-200">
            <h4 class="font-bold text-xl text-red-700 mb-4 flex items-center">
                <x-heroicon-o-trash class="h-6 w-6 text-red-600 mr-2" />
                Hapus Data Audit Trail Lama
            </h4>
            <p class="text-gray-700 mb-4">
                Anda dapat menghapus data log audit trail yang lebih tua dari periode tertentu untuk menjaga ukuran database dan relevansi data.
                Disarankan untuk menghapus data secara berkala, misalnya **3 bulan sekali**.
            </p>
            <form action="{{ route('admin.audit-trails.purge') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data audit trail yang lebih lama dari tanggal yang dipilih? Aksi ini tidak dapat dibatalkan.');">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row items-end gap-4">
                    <div>
                        <label for="purge_date" class="block text-sm font-medium text-gray-700">Hapus Log Lebih Tua Dari Tanggal:</label>
                        <input type="date" name="purge_date" id="purge_date" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <x-heroicon-o-trash class="h-4 w-4 mr-2" />
                        Hapus Log
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection