<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">
    Data Orang Tua & Alamat
</h3>

{{-- Nama Orang Tua/Wali --}}
<x-form.input
    id="parent_name"
    name="parent_name"
    label="Nama Orang Tua/Wali"
    placeholder="Contoh: H. Abdul Hakim"
    :value="$applicant->parent_name ?? ''"
    required
/>

{{-- Nomor HP Orang Tua/Wali --}}
<x-form.input
    id="parent_phone"
    name="parent_phone"
    label="No. HP Orang Tua/Wali"
    placeholder="Contoh: 081234567890"
    type="tel"
    inputmode="numeric"
    :value="$applicant->parent_phone ?? ''"
    required
/>

{{-- Email Orang Tua/Wali (Opsional) --}}
<x-form.input
    id="parent_email"
    name="parent_email"
    label="Email Orang Tua/Wali"
    placeholder="Contoh: ayah@email.com"
    type="email"
    :value="$applicant->parent_email ?? ''"
    note="(opsional)"
/>

{{-- Pekerjaan Orang Tua/Wali --}}
<x-form.select
    id="parent_occupation"
    name="parent_occupation"
    label="Pekerjaan Orang Tua/Wali"
    :options="[
        'Petani' => 'Petani',
        'Nelayan' => 'Nelayan',
        'Pedagang' => 'Pedagang',
        'PNS' => 'PNS',
        'Guru' => 'Guru',
        'Dosen' => 'Dosen',
        'Dokter' => 'Dokter',
        'Perawat' => 'Perawat',
        'TNI/POLRI' => 'TNI/POLRI',
        'Karyawan Swasta' => 'Karyawan Swasta',
        'Karyawan BUMN' => 'Karyawan BUMN',
        'Wiraswasta' => 'Wiraswasta',
        'Sopir' => 'Sopir',
        'Buruh' => 'Buruh',
        'Ibu Rumah Tangga' => 'Ibu Rumah Tangga',
        'Tidak Bekerja' => 'Tidak Bekerja',
        'Sudah Meninggal' => 'Sudah Meninggal'
    ]"
    :selected="$applicant->parent_occupation ?? ''"
    placeholder="Pilih pekerjaan orang tua/wali"
    required
/>

{{-- Alamat Lengkap --}}
<x-form.textarea
    id="address"
    name="address"
    label="Alamat Lengkap"
    placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel"
    rows="3"
    :value="$applicant->address ?? ''"
    required
/>

{{-- Wilayah: Provinsi, Kota/Kabupaten, Kecamatan, Kelurahan --}}
<x-form.wilayah
    :province="$applicant->province ?? ''"
    :city="$applicant->city ?? ''"
    :district="$applicant->district ?? ''"
    :village="$applicant->village ?? ''"
/>
