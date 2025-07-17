@extends('layouts.admin')

@section('title', 'Kelola Santri di Halaqoh')
@section('header_admin', 'Manajemen Santri Halaqoh: ' . $halaqoh->name)

@section('admin_content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-teal-700">Santri Halaqoh "{{ $halaqoh->name }}"</h2>
        <a href="{{ route('admin.halaqohs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            &larr; Kembali ke Halaqoh
        </a>
    </div>

    {{-- Form Filter --}}
    <form method="GET" action="{{ route('admin.halaqohs.manage_students', $halaqoh) }}" class="space-y-3 mb-4">
        <div class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari Nama atau NIS..."
                class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/3">

            <select name="type" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4">
                <option value="">Semua Jenis</option>
                <option value="Asrama" {{ request('type') == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                <option value="Pulang-Pergi" {{ request('type') == 'Pulang-Pergi' ? 'selected' : '' }}>Pulang Pergi</option>
            </select>

            @if(request('type') == 'Pulang-Pergi')
                <select name="halaqoh_period" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4">
                    <option value="">Semua Periode</option>
                    <option value="Sore" {{ request('halaqoh_period') == 'Sore' ? 'selected' : '' }}>Sore</option>
                    <option value="Malam" {{ request('halaqoh_period') == 'Malam' ? 'selected' : '' }}>Malam</option>
                </select>
            @endif

            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
                Filter
            </button>

            <a href="{{ route('admin.halaqohs.manage_students', $halaqoh) }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">
                Reset
            </a>
        </div>
    </form>

    {{-- Form Tambah Santri --}}
    <form method="POST" action="{{ route('admin.halaqohs.update_students', $halaqoh) }}">
        @csrf

        <div class="mb-4">
            <label for="student_ids" class="block font-semibold mb-2">Pilih Santri</label>
            <select id="student_ids" name="student_ids[]" multiple class="student-select w-full"></select>
            <p class="text-sm text-gray-500 mt-1">Santri hanya dapat masuk ke satu halaqoh.</p>
        </div>

        <button type="submit"
            class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection

@push('scripts')
<!-- TomSelect CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    new TomSelect('.student-select', {
        maxItems: null,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        plugins: ['remove_button'],
        placeholder: 'Ketik nama atau NIS santri...',
        load: function(query, callback) {
            if (!query.length) return callback();
            fetch(`admin/api/students/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(callback)
                .catch(() => callback());
        }
    });
});
</script>
@endpush
