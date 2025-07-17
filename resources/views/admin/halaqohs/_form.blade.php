@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Nama Halaqoh --}}
    <div>
        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Halaqoh</label>
        <input type="text" name="name" id="name" required
               value="{{ old('name', $halaqoh->name ?? '') }}"
               class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">
    </div>

    {{-- Guru Ngaji --}}
    <div>
        <label for="teacher_id" class="block text-sm font-semibold text-gray-700 mb-1">Guru Ngaji</label>
        <select name="teacher_id" id="teacher_id"
                class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">
            <option value="">-- Pilih Guru --</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}"
                        {{ old('teacher_id', $halaqoh->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Periode Ngaji --}}
    <div>
        <label for="period" class="block text-sm font-semibold text-gray-700 mb-1">Periode Ngaji</label>
        <select name="period" id="period"
                class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">
            <option value="">-- Pilih Periode --</option>
            <option value="Sore" {{ old('period', $halaqoh->period ?? '') == 'Sore' ? 'selected' : '' }}>Sore</option>
            <option value="Malam" {{ old('period', $halaqoh->period ?? '') == 'Malam' ? 'selected' : '' }}>Malam</option>
        </select>
        <p class="text-xs text-gray-500 mt-2">Gunakan untuk memfilter santri pulang-pergi sesuai periode pilihannya.</p>
    </div>

    {{-- Batas Maksimal Santri --}}
    <div>
        <label for="student_limit" class="block text-sm font-semibold text-gray-700 mb-1">Batas Maksimal Santri</label>
        <input type="number" name="student_limit" id="student_limit" min="1"
               placeholder="Contoh: 18"
               class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500"
               value="{{ old('student_limit', $halaqoh->student_limit ?? '') }}">
        <p class="text-xs text-gray-500 mt-2">Kosongkan jika tidak ada batas kuota.</p>
    </div>

    {{-- Status Halaqoh --}}
    <div>
        <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
        <select name="status" id="status"
                class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">
            <option value="active" {{ old('status', $halaqoh->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ old('status', $halaqoh->status ?? '') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            <option value="completed" {{ old('status', $halaqoh->status ?? '') == 'completed' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>

    {{-- Deskripsi --}}
    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi (Opsional)</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">{{ old('description', $halaqoh->description ?? '') }}</textarea>
    </div>
</div>

{{-- Tombol Simpan --}}
<div class="pt-6">
    <button type="submit"
            class="w-full sm:w-auto bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md shadow font-semibold">
        Simpan Halaqoh
    </button>
</div>
