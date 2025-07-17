@extends('layouts.admin')

@section('title', 'Kelola Santri di Halaqoh')
@section('header_admin', 'Manajemen Santri Halaqoh: ' . $halaqoh->name)

@section('admin_content')
<div class="bg-white shadow rounded-lg p-6" x-data="{
    quota: {{ $limit ?? 'null' }},
    current: {{ $currentCount }},
    isFull() { return this.quota !== null && this.current >= this.quota }
}">
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

            <select
                id="student_ids"
                name="student_ids[]"
                multiple
                class="student-select w-full"
                x-bind:disabled="isFull()"
                x-bind:class="isFull() ? 'bg-gray-100 cursor-not-allowed opacity-60' : ''"
            >
                @foreach ($selectedStudents as $student)
                    <option value="{{ $student->id }}" selected>{{ $student->name }} - {{ $student->nis }}</option>
                @endforeach
            </select>

            <p class="text-sm text-gray-500 mt-1">
                Kuota: {{ $limit ?? '∞' }} | Terisi: {{ $currentCount }} | Sisa: {{ $limit ? max(0, $limit - $currentCount) : '∞' }}
            </p>

            <template x-if="isFull()">
                <p class="text-sm text-red-500 mt-2">Kuota halaqoh penuh. Tidak dapat menambahkan santri.</p>
            </template>
        </div>

        <button type="submit"
            class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700"
            x-bind:disabled="isFull()"
        >
            Simpan Perubahan
        </button>
    </form>

    {{-- Daftar Santri Terpilih --}}
    @if($selectedStudents->count())
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Santri Terdaftar di Halaqoh Ini:</h3>
            <ul class="space-y-2">
                @foreach($selectedStudents as $student)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md">
                        <span>
                            {{ $student->name }} (NIS: {{ $student->nis }}) - {{ $student->type }}
                            @if($student->type === 'Pulang-Pergi')
                                [{{ $student->halaqoh_period }}]
                            @endif
                        </span>
                        <form method="POST" action="{{ route('admin.halaqohs.remove_student', [$halaqoh, $student]) }}" onsubmit="return confirm('Yakin ingin menghapus {{ $student->name }} dari halaqoh?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                Hapus
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<!-- TomSelect & Alpine -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const maxQuota = {{ $limit ?? 'null' }};
    const currentCount = {{ $currentCount }};
    const isFull = maxQuota !== null && currentCount >= maxQuota;

    if (!isFull) {
        new TomSelect('.student-select', {
            maxItems: null,
            valueField: 'value',
            labelField: 'text',
            searchField: 'text',
            plugins: ['remove_button'],
            placeholder: 'Ketik nama atau NIS santri...',
            load: function(query, callback) {
                if (!query.length) return callback();
                fetch(`/admin/api/students/search?q=${encodeURIComponent(query)}&halaqoh_id={{ $halaqoh->id }}`)
                    .then(response => response.json())
                    .then(callback)
                    .catch(() => callback());
            }
        });
    }
});
</script>
@endpush
