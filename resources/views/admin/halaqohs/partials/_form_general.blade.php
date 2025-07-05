<h3 class="text-2xl font-semibold text-teal-700 mb-6 border-b pb-2">Informasi Halaqoh</h3>

{{-- Nama Halaqoh --}}
<div class="mb-5">
    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Halaqoh <span class="text-red-500">*</span></label>
    <input type="text" name="name" id="name" placeholder="Contoh: Halaqoh Tahfidz Pagi"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        value="{{ old('name') }}" required>
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

{{-- Deskripsi --}}
<div class="mb-5">
    <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi (Opsional)</label>
    <textarea name="description" id="description" rows="3" placeholder="Tulis deskripsi singkat..."
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('description') }}</textarea>
    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

{{-- Pengajar --}}
<div class="mb-5">
    <label for="teacher_id" class="block text-sm font-semibold text-gray-700">Pengajar Utama</label>
    <select name="teacher_id" id="teacher_id"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">-- Pilih Pengajar --</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                {{ $teacher->full_name }} ({{ $teacher->specialization ?? 'Umum' }})
            </option>
        @endforeach
    </select>
    @error('teacher_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

{{-- Tanggal --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
    <div>
        <label for="start_date" class="block text-sm font-semibold text-gray-700">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date"
            class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            value="{{ old('start_date') }}">
        @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="end_date" class="block text-sm font-semibold text-gray-700">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date"
            class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            value="{{ old('end_date') }}">
        @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- Status --}}
<div class="mb-5">
    <label for="status" class="block text-sm font-semibold text-gray-700">Status Halaqoh</label>
    <select name="status" id="status"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
    </select>
    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

{{-- Batas Santri --}}
<div class="mb-5">
    <label for="student_limit" class="block text-sm font-semibold text-gray-700">Batas Jumlah Santri</label>
    <input type="number" name="student_limit" id="student_limit"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        value="{{ old('student_limit', 0) }}" min="0">
    <p class="text-gray-500 text-xs mt-1">Masukkan 0 untuk tanpa batas.</p>
    @error('student_limit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
