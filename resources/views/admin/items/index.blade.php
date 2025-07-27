@extends('layouts.admin')

@section('title', 'Daftar Inventaris')
@section('header_admin', 'Daftar Inventaris')

@section('admin_content')
    <h2 class="text-xl font-bold text-teal-700 mb-4">Inventaris</h2>
    <p>Ini halaman untuk menampilkan daftar barang.</p>
@endsection
@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Daftar Inventaris</h3>

            <div class="mb-6">
                <a href="{{ route('admin.items.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white font-semibold rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
                    Tambah Inventaris Baru
                </a>
            </div>

            @if ($items->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->condition }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.items.edit', $item) }}" class="text-teal-600 hover:text-teal-800 font-semibold">Edit</a>
                                    |
                                    <form action="{{ route('admin.items.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $items->links() }}
                </div>
            @else
                <p class="text-gray-500">Tidak ada inventaris yang ditemukan.</p>
            @endif
        </div>
    </div>
@endsection
        