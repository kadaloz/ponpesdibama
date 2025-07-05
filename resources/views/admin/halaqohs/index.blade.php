@extends('layouts.admin')

@section('title', 'Manajemen Halaqoh')
@section('header_admin', 'Manajemen Halaqoh')

@section('admin_content')
<div class="bg-white shadow-sm rounded-lg p-6">
    {{-- Header & Tambah --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h3 class="text-2xl md:text-3xl font-bold text-teal-700">Daftar Halaqoh</h3>
        
        @can('create halaqohs')
            <a href="{{ route('admin.halaqohs.create') }}"
               class="inline-flex items-center px-5 py-2.5 bg-teal-600 text-white text-sm rounded-md hover:bg-teal-700 transition shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Halaqoh
            </a>
        @endcan
    </div>

    {{-- Filter & Search --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.halaqohs.index') }}" class="flex flex-wrap items-center gap-3">
            <input type="text" name="search" placeholder="Cari nama halaqoh / pengajar..." value="{{ request('search') }}"
                class="text-sm px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            
            <select name="status" class="text-sm px-6 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                <option value="">-- Semua Status --</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm rounded-md hover:bg-teal-700 transition">
                Filter
            </button>

            @if(request()->has('search') || request()->has('status'))
                <a href="{{ route('admin.halaqohs.index') }}" class="text-sm text-gray-600 hover:underline ml-2">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded shadow-sm text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    @if ($allHalaqohs->isEmpty())
        <p class="text-center text-gray-600 bg-gray-50 py-8 rounded border border-dashed">
            Belum ada halaqoh terdaftar.
        </p>
    @else
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Pengajar</th>
                        <th class="px-4 py-3 text-left">Santri</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach ($allHalaqohs as $halaqoh)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $halaqoh->name }}</td>
                            <td class="px-4 py-3">{{ $halaqoh->teacher->full_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $halaqoh->students->count() }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $halaqoh->status == 'active' ? 'bg-green-100 text-green-700' :
                                       ($halaqoh->status == 'inactive' ? 'bg-yellow-100 text-yellow-700' :
                                       ($halaqoh->status == 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700')) }}">
                                    {{ ucfirst($halaqoh->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                @can('view halaqohs')
                                    <a href="{{ route('admin.halaqohs.show', $halaqoh->id) }}"
                                       class="inline-flex items-center px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                                  -1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </a>
                                @endcan
                                @can('edit halaqohs')
                                    <a href="{{ route('admin.halaqohs.edit', $halaqoh->id) }}"
                                       class="inline-flex items-center px-3 py-1 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036
                                                  a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                    </a>
                                @endcan
                                @can('delete halaqohs')
                                    <form action="{{ route('admin.halaqohs.destroy', $halaqoh->id) }}" method="POST"
                                          class="inline" onsubmit="return confirm('Hapus halaqoh ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                      a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $allHalaqohs->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
