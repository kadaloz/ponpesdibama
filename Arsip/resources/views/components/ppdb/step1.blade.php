<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Nama Lengkap --}}
    <div>
        <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
        <input type="text" name="full_name" id="full_name" required autofocus
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: Ahmad Fulan" value="{{ old('full_name') }}">
        @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Jenis Kelamin --}}
    <div>
        <label for="gender" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
        <select name="gender" id="gender" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Tempat Lahir --}}
    <div>
        <label for="place_of_birth" class="block text-sm font-semibold text-gray-700 mb-1">Tempat Lahir</label>
        <input type="text" name="place_of_birth" id="place_of_birth"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: Mataram" value="{{ old('place_of_birth') }}">
    </div>

    {{-- Tanggal Lahir --}}
    <div>
        <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
        <input type="text" name="date_of_birth" id="date_of_birth"
            class="flatpickr w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Pilih tanggal lahir" value="{{ old('date_of_birth') }}">
    </div>


    {{-- NISN --}}
    <div>
        <label for="nisn" class="block text-sm font-semibold text-gray-700 mb-1">NISN</label>
        <input type="text" name="nisn" id="nisn"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="10 digit NISN" value="{{ old('nisn') }}">
    </div>

    {{-- Pendidikan Terakhir --}}
    <div>
        <label for="last_education" class="block text-sm font-semibold text-gray-700 mb-1">Pendidikan Terakhir</label>
        <input type="text" name="last_education" id="last_education"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: SD/MI/SMP" value="{{ old('last_education') }}">
    </div>

    {{-- Asal Sekolah --}}
    <div class="md:col-span-2">
        <label for="school_origin" class="block text-sm font-semibold text-gray-700 mb-1">Asal Sekolah</label>
        <input type="text" name="school_origin" id="school_origin"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: SDN 1 Aikmel" value="{{ old('school_origin') }}">
    </div>
</div>
