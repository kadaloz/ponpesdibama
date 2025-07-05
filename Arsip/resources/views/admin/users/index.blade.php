{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Akun Pengguna')

@section('header_admin', 'Manajemen Akun Pengguna')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-teal-700">Daftar Pengguna</h3>
                @role('admin') {{-- Hanya admin yang bisa menambah user --}}
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pengguna Baru
                    </a>
                @endrole
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($allUsers->isEmpty())
                <p class="text-gray-600 text-center py-4">Belum ada pengguna terdaftar.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Peran</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($allUsers as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-500">{{ $user->email }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-500">
                                        @forelse ($user->getRoleNames() as $role)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $role }}
                                            </span>
                                        @empty
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Tidak Ada Peran
                                            </span>
                                        @endforelse
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium whitespace-nowrap">
                                        @role('admin') {{-- Hanya admin yang bisa mengedit/menghapus --}}
                                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center text-white bg-indigo-500 hover:bg-indigo-600 mx-1 px-3 py-1 rounded-md transition-colors duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h16a1 1 0 011 1v1a1 1 0 01-1 1z"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endrole
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
