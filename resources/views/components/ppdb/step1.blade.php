<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Nama Lengkap --}}
    <x-form.group label="Nama Lengkap" name="full_name" required autofocus />

    {{-- Jenis Kelamin --}}
    <x-form.group label="Jenis Kelamin" name="gender" as="select" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </x-form.group>

    {{-- Tempat Lahir --}}
    <x-form.group label="Tempat Lahir" name="place_of_birth" />

    {{-- Tanggal Lahir --}}
    <x-form.group label="Tanggal Lahir" name="date_of_birth"
        class="flatpickr" placeholder="Pilih tanggal lahir" />

    {{-- NISN --}}
    <x-form.group label="NISN" name="nisn" placeholder="10 digit NISN" />

    {{-- Pendidikan Terakhir --}}
    <x-form.group label="Pendidikan Terakhir" name="last_education" placeholder="Contoh: SD/MI/SMP" />

    {{-- Asal Sekolah --}}
    <div class="md:col-span-2">
        <x-form.group label="Asal Sekolah" name="school_origin" placeholder="Contoh: SDN 1 Aikmel" />
    </div>
</div>
