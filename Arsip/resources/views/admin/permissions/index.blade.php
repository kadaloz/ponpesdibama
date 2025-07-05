{{-- resources/views/admin/permissions/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Peran & Izin')

@section('header_admin', 'Manajemen Peran & Izin Pengguna')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Daftar Peran Pengguna</h3>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($roles->isEmpty())
                <p class="text-gray-600 text-center py-4">Belum ada peran yang terdaftar. Jalankan seeder.</p>
            @else
                <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Peran</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jumlah Pengguna</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Izin Terkait (Contoh)</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($roles as $role)
                                <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ ucfirst($role->name) }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-500">{{ $role->users()->count() }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-500">
                                        @forelse ($role->permissions->take(3) as $permission) {{-- Tampilkan 3 izin pertama --}}
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="text-gray-400 italic">Tidak ada izin spesifik</span>
                                        @endforelse
                                        @if ($role->permissions->count() > 3)
                                            <span class="text-gray-400">...</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium whitespace-nowrap">
                                        <a href="{{ route('admin.permissions.edit', $role->id) }}" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                            <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            Edit Izin
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
