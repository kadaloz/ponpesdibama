@extends('layouts.admin')

@section('title', 'Kelola Santri di Halaqoh')
@section('header_admin', 'Manajemen Santri Halaqoh: ' . $halaqoh->name)

@section('admin_content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold text-teal-700 mb-4">Santri dalam Halaqoh "{{ $halaqoh->name }}"</h2>

        <form method="POST" action="{{ route('admin.halaqohs.update_students', $halaqoh) }}">
            @csrf

            <div class="mb-4">
                <label for="student_ids" class="block font-semibold mb-2">Pilih Santri</label>
                <select name="student_ids[]" id="student_ids"
                    class="w-full border border-gray-300 rounded-lg shadow-sm" multiple size="10">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ $halaqoh->students->contains($student->id) ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->type }} | {{ $student->halaqoh_period ?? 'Tanpa Periode' }})
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Santri hanya dapat masuk ke satu halaqoh.</p>
            </div>

            <button type="submit"
                class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
