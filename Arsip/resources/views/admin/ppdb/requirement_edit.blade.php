@extends('layouts.admin')

@section('title', 'Edit Syarat Pendaftaran PPDB')
@section('header_admin', 'Syarat Pendaftaran')

@section('admin_content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.ppdb-requirements.update') }}">
        @csrf
        @method('PUT')

        <label for="content" class="block font-semibold text-gray-700 mb-2">Syarat Pendaftaran</label>
        <textarea name="content" id="content" rows="10" class="w-full border-gray-300 rounded shadow-sm">{{ old('content', $requirement->content ?? '') }}</textarea>

        <button class="mt-4 px-6 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Simpan</button>
    </form>
</div>
@endsection