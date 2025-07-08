<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Informasi Alamat</h3>
<div class="space-y-4">
    <x-textarea label="Alamat Lengkap" name="address" required />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-select label="Provinsi" name="province" id="province" required />
        <x-select label="Kota/Kabupaten" name="city" id="city" required />
        <x-select label="Kecamatan" name="district" id="district" required />
        <x-select label="Kelurahan/Desa" name="village" id="village" required />
    </div>
</div>
