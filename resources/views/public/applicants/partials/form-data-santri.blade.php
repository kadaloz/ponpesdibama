<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>
<div class="space-y-4">
    <x-input label="Nama Lengkap" name="full_name" required />

    <x-select label="Jenis Kelamin" name="gender" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki" @selected(old('gender')=='Laki-laki')>Laki-laki</option>
        <option value="Perempuan" @selected(old('gender')=='Perempuan')>Perempuan</option>
    </x-select>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-input label="Tempat Lahir" name="place_of_birth" />
        <x-input label="Tanggal Lahir" name="date_of_birth" type="date" />
    </div>

    <x-input label="NISN (Nomor Induk Siswa Nasional)" name="nisn" />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-input label="Pendidikan Terakhir" name="last_education" />
        <x-input label="Asal Sekolah" name="school_origin" />
    </div>
</div>
