{{-- resources/views/admin/students/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Data Santri Baru')

@section('header_admin', 'Tambah Data Santri')

@section('admin_content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            {{-- Header --}}
            <div class="bg-teal-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <x-heroicon-o-user-plus class="h-8 w-8 text-white mr-3" /> {{-- Ikon untuk tambah --}}
                    <h1 class="text-2xl font-bold text-white">Tambah Data Santri Baru</h1>
                </div>
                <a href="{{ route('admin.students.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-500 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                    Kembali ke Daftar
                </a>
            </div>

            <div class="p-6 text-gray-900">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm flex items-center" role="alert">
                        <x-heroicon-o-check-circle class="h-5 w-5 mr-2" />
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm flex items-center" role="alert">
                        <x-heroicon-o-exclamation-circle class="h-5 w-5 mr-2" />
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Memanggil komponen form --}}
                    <x-forms.santri-form :halaqohPeriods="$halaqohPeriods" :programs="$programs"/> {{-- $student tidak perlu dilewatkan karena ini create --}}

                    <div class="mt-8 flex justify-end space-x-4 border-t pt-6 border-gray-200">
                        <a href="{{ route('admin.students.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <x-heroicon-o-x-mark class="h-5 w-5 mr-2" />
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <x-heroicon-o-plus class="h-5 w-5 mr-2" />
                            Tambah Santri
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Memanggil komponen script --}}
    <x-scripts.region-scripts /> {{-- $student tidak perlu dilewatkan karena ini create --}}
@endsection