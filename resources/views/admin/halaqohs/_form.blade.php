@csrf

<div class="space-y-4">
    {{-- Nama Halaqoh --}}
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700">Nama Halaqoh</label>
        <input type="text" name="name" id="name" required
               value="{{ old('name', $halaqoh->name ?? '') }}"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi (Opsional)</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('description', $halaqoh->description ?? '') }}</textarea>
    </div>

    {{-- Guru Ngaji --}}
    <div>
        <label for="teacher_id" class="block font-medium text-sm text-gray-700">Guru Ngaji</label>
        <select name="teacher_id" id="teacher_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
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
        <label for="period" class="block font-medium text-sm text-gray-700">Periode Ngaji</label>
        <select name="period" id="period"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">-- Pilih Periode --</option>
            <option value="Sore" {{ old('period', $halaqoh->period ?? '') == 'Sore' ? 'selected' : '' }}>Sore</option>
            <option value="Malam" {{ old('period', $halaqoh->period ?? '') == 'Malam' ? 'selected' : '' }}>Malam</option>
        </select>
        <p class="text-xs text-gray-500 mt-1">Gunakan untuk memfilter santri pulang-pergi sesuai periode pilihannya.</p>
    </div>

    {{--Batas Maksimal Santri (Kuota)--}}
    <div class="mb-4">
        <label for="student_limit" class="block font-semibold mb-2">Batas Maksimal Santri (Kuota)</label>
        <input type="number" name="student_limit" id="student_limit" min="1"
            class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2"
            value="{{ old('student_limit', $halaqoh->student_limit ?? '') }}"
            placeholder="Contoh: 18">
        <p class="text-sm text-gray-500 mt-1">Isi dengan jumlah maksimal santri dalam halaqoh ini. Boleh dikosongkan untuk tanpa batas.</p>
    </div>


    {{-- Status Halaqoh --}}
    <div>
        <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
        <select name="status" id="status"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="active" {{ old('status', $halaqoh->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ old('status', $halaqoh->status ?? '') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            <option value="completed" {{ old('status', $halaqoh->status ?? '') == 'completed' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>

    {{-- Tombol Simpan --}}
    <div class="pt-4">
        <button type="submit"
                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md shadow font-semibold">
            Simpan Halaqoh
        </button>
    </div>
</div>
