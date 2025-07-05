{{-- resources/views/admin/permissions/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Izin Peran: ' . ucfirst($role->name))

@section('header_admin', 'Edit Izin untuk Peran ' . ucfirst($role->name))

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Kelola Izin untuk Peran: <span class="text-indigo-700">{{ ucfirst($role->name) }}</span></h3>

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

            <form action="{{ route('admin.permissions.update', $role->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @if ($role->name === 'admin')
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                        <span class="block sm:inline">Peran 'admin' secara otomatis memiliki semua izin. Tidak dapat diubah secara manual.</span>
                    </div>
                @endif

                <div class="space-y-8"> {{-- Spacing antar kategori --}}
                    @foreach ($categorizedPermissions as $categoryName => $permissionsInGroup)
                        @if (!empty($permissionsInGroup)) {{-- Hanya tampilkan kategori jika ada izin di dalamnya --}}
                            <div class="border border-gray-200 rounded-lg p-5 shadow-sm bg-gray-50">
                                <h4 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">{{ $categoryName }}</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"> {{-- Izin dalam grid --}}
                                    @foreach ($permissionsInGroup as $permission)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                                   class="h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                                                   {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}
                                                   {{ $role->name === 'admin' ? 'disabled' : '' }}>
                                            <label for="permission_{{ $permission->id }}" class="ml-2 block text-sm text-gray-900">
                                                {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                @error('permissions')
                    <p class="text-red-500 text-xs mt-1 col-span-full">{{ $message }}</p>
                @enderror
                @error('permissions.*')
                    <p class="text-red-500 text-xs mt-1 col-span-full">{{ $message }}</p>
                @enderror

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg"
                            {{ $role->name === 'admin' ? 'disabled' : '' }}>
                        Simpan Izin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
