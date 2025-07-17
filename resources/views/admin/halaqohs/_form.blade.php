@csrf

<div class="space-y-6"> {{-- Memberikan jarak vertikal antar bagian --}}

    {{-- Bagian: Informasi Dasar Halaqoh --}}
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            {{-- Heroicon: Academic Cap (untuk ikon utama bagian) --}}
            {{-- Sesuaikan dengan cara Anda memanggil Heroicon di Laravel --}}
            <x-heroicon-o-academic-cap class="h-6 w-6 text-teal-600 mr-2" />
            Informasi Dasar Halaqoh
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Halaqoh --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                    <span class="flex items-center">
                        {{-- Heroicon: Book Open (untuk nama halaqoh) --}}
                        <x-heroicon-o-book-open class="h-4 w-4 text-gray-500 mr-1" />
                        Nama Halaqoh
                    </span>
                </label>
                <input type="text" name="name" id="name" required placeholder="Contoh: Halaqoh Tahfidz Putra"
                       value="{{ old('name', $halaqoh->name ?? '') }}"
                       class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">
            </div>

            {{-- Guru Ngaji --}}
            <div>
                <label for="teacher_id" class="block text-sm font-semibold text-gray-700 mb-1">
                    <span class="flex items-center">
                        {{-- Heroicon: User (untuk guru ngaji) --}}
                        <x-heroicon-o-user class="h-4 w-4 text-gray-500 mr-1" />
                        Guru Ngaji
                    </span>
                </label>
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
        </div>
    </div>


    {{-- Bagian: Jadwal & Kapasitas --}}
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            {{-- Heroicon: Clock (untuk ikon utama bagian) --}}
            <x-heroicon-o-clock class="h-6 w-6 text-teal-600 mr-2" />
            Jadwal & Kapasitas
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Periode Ngaji --}}
            <div>
                <label for="period" class="block text-sm font-semibold text-gray-700 mb-1">
                    <span class="flex items-center">
                        {{-- Heroicon: Calendar (untuk periode ngaji) --}}
                        <x-heroicon-o-calendar class="h-4 w-4 text-gray-500 mr-1" />
                        Periode Ngaji
                    </span>
                </label>
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
                <label for="student_limit" class="block text-sm font-semibold text-gray-700 mb-1">
                    <span class="flex items-center">
                        {{-- Heroicon: Users (untuk batas maksimal santri) --}}
                        <x-heroicon-o-users class="h-4 w-4 text-gray-500 mr-1" />
                        Batas Maksimal Santri
                    </span>
                </label>
                <input type="number" name="student_limit" id="student_limit" min="1"
                       placeholder="Contoh: 18"
                       class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500"
                       value="{{ old('student_limit', $halaqoh->student_limit ?? '') }}">
                <p class="text-xs text-gray-500 mt-2">Kosongkan jika tidak ada batas kuota.</p>
            </div>
        </div>
    </div>


    {{-- Bagian: Detail Lainnya --}}
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            {{-- Heroicon: Adjustments Horizontal (untuk ikon utama bagian) --}}
            <x-heroicon-o-adjustments-horizontal class="h-6 w-6 text-teal-600 mr-2" />
            Detail Lainnya
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Status Halaqoh --}}
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">
                    <span class="flex items-center">
                        {{-- Heroicon: Check Circle (untuk status) --}}
                        <x-heroicon-o-check-circle class="h-4 w-4 text-gray-500 mr-1" />
                        Status Halaqoh
                    </span>
                </label>
                <select name="status" id="status"
                        class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">
                    <option value="active" {{ old('status', $halaqoh->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $halaqoh->status ?? '') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="completed" {{ old('status', $halaqoh->status ?? '') == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mt-6"> {{-- Menambahkan jarak atas untuk spasi --}}
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                <span class="flex items-center">
                    {{-- Heroicon: Pencil (untuk deskripsi) --}}
                    <x-heroicon-o-pencil class="h-4 w-4 text-gray-500 mr-1" />
                    Deskripsi (Opsional)
                </span>
            </label>
            <textarea name="description" id="description" rows="3" placeholder="Tambahkan detail atau catatan penting tentang halaqoh ini..."
                      class="w-full px-4 py-2 border rounded-md shadow-sm border-gray-300 focus:ring-teal-500 focus:border-teal-500">{{ old('description', $halaqoh->description ?? '') }}</textarea>
        </div>
    </div>
</div>


{{-- Tombol Simpan --}}
<div class="mt-8 flex justify-end"> {{-- Menggunakan mt-8 untuk jarak vertikal lebih banyak dan justify-end untuk penempatan di kanan --}}
    <a href="{{ route('admin.halaqohs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 mr-4">
        <x-heroicon-o-arrow-left class="w-5 h-5 mr-2" /> Kembali ke Daftar Halaqoh
    </a>    

    <button type="submit"
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
        {{-- Heroicon: Save --}}
        <!-- SVG Save Icon (Heroicon Outline) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16v2a2 2 0 002 2H5a2 2 0 01-2-2V6a2 2 0 012-2h11l4 4v8a2 2 0 01-2 2z" />
        </svg>
        Simpan Data Halaqoh
    </button>
</div>