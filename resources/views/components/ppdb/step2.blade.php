<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Orang Tua & Alamat</h3>

{{-- Nama Orang Tua --}}
<x-form.group label="Nama Orang Tua/Wali" name="parent_name" required />

{{-- No HP --}}
<x-form.group label="No. HP Orang Tua/Wali" name="parent_phone" required />

{{-- Email (opsional) --}}
<x-form.group label="Email Orang Tua/Wali (opsional)" name="parent_email" type="email" />

{{-- Pekerjaan --}}
<x-form.group label="Pekerjaan Orang Tua/Wali" name="parent_occupation" />

{{-- Alamat Lengkap --}}
<x-form.group label="Alamat Lengkap" name="address" as="textarea" required />

{{-- Wilayah --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Provinsi --}}
    <x-form.group label="Provinsi" name="province" as="select" required>
        <option value="">Pilih Provinsi</option>
    </x-form.group>

    {{-- Kabupaten/Kota --}}
    <x-form.group label="Kabupaten/Kota" name="city" as="select" required>
        <option value="">Pilih Kabupaten/Kota</option>
    </x-form.group>

    {{-- Kecamatan --}}
    <x-form.group label="Kecamatan" name="district" as="select" required>
        <option value="">Pilih Kecamatan</option>
    </x-form.group>

    {{-- Kelurahan --}}
    <x-form.group label="Kelurahan/Desa" name="village" as="select" required>
        <option value="">Pilih Kelurahan/Desa</option>
    </x-form.group>
</div>
