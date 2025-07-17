@extends('layouts.admin')

@section('title', 'Detail Kamar Asrama')
@section('header_admin', 'Detail Kamar Asrama')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Detail Kamar: {{ $room->room_number }}</h3>

            <div class="mb-8 p-6 bg-teal-50 rounded-xl shadow-inner border border-teal-200">
                <h4 class="font-bold text-xl text-teal-700 mb-4 flex items-center">
                    <x-heroicon-o-building-library class="h-6 w-6 text-teal-600 mr-2" /> Informasi Kamar
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-800 text-lg">
                    <div>
                        <p class="font-medium">Nomor / Nama Kamar:</p>
                        <p class="block text-xl font-bold text-teal-800">{{ $room->room_number }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Kapasitas:</p>
                        <p class="block">{{ $room->capacity }} Santri</p>
                    </div>
                    <div>
                        <p class="font-medium">Jenis Kelamin Penghuni:</p>
                        <p class="block capitalize">{{ $room->gender_type }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Status Kamar:</p>
                        <p class="block text-xl font-bold px-3 py-1 rounded-full inline-block {{
                            $room->status == 'available' ? 'bg-green-100 text-green-800' :
                            ($room->status == 'full' ? 'bg-red-100 text-red-800' :
                            ($room->status == 'renovation' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))
                        }}">
                            {{ ucfirst(str_replace('_', ' ', $room->status)) }}
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="font-medium">Deskripsi / Fasilitas:</p>
                        <p class="block text-gray-700">{{ $room->description ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- TODO: Bagian untuk menampilkan santri yang menempati kamar ini --}}
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2 flex items-center">
                    <x-heroicon-o-users class="h-6 w-6 text-gray-600 mr-2" /> Santri Penghuni (Akan Datang)
                </h4>
                <p class="text-gray-600 italic">Fitur penempatan santri akan ditambahkan di bagian selanjutnya.</p>
            </div>

            {{-- TODO: Bagian untuk menampilkan inventaris di kamar ini --}}
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2 flex items-center">
                    <x-heroicon-o-archive-box class="h-6 w-6 text-gray-600 mr-2" /> Inventaris Kamar (Akan Datang)
                </h4>
                <p class="text-gray-600 italic">Fitur inventaris asrama akan ditambahkan di bagian selanjutnya.</p>
            </div>


            <div class="mt-10 text-center border-t pt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-2 -ml-1" />
                    Kembali ke Daftar Kamar
                </a>
                <a href="{{ route('admin.rooms.edit', $room) }}" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <x-heroicon-o-pencil-square class="w-4 h-4 mr-2 -ml-1" />
                    Edit Kamar
                </a>
            </div>
        </div>
    </div>
@endsection