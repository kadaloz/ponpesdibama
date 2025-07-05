{{-- resources/views/admin/halaqohs/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Halaqoh Baru')
@section('header_admin', 'Buat Halaqoh Baru')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <form action="{{ route('admin.halaqohs.store') }}" method="POST" class="space-y-6">
            @csrf

            @include('admin.halaqohs.partials._form_general')
            @include('admin.halaqohs.partials._form_students')
            @include('admin.halaqohs.partials._form_schedules')

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.halaqohs.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 shadow-sm mr-2">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 text-white rounded-full font-semibold hover:bg-teal-800 shadow-lg">
                    Simpan Halaqoh
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.halaqohs.partials._script')
@endsection
