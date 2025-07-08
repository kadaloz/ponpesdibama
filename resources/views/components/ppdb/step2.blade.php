<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Orang Tua & Alamat</h3>

{{-- Nama Orang Tua --}}
<div class="mb-4">
    <label for="parent_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Orang Tua/Wali</label>
    <input type="text" name="parent_name" id="parent_name" required
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: H. Abdul Hakim" value="{{ old('parent_name') }}">
</div>

{{-- No HP --}}
<div class="mb-4">
    <label for="parent_phone" class="block text-sm font-semibold text-gray-700 mb-1">No. HP Orang Tua/Wali</label>
    <input type="text" name="parent_phone" id="parent_phone" required
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: 081234567890" value="{{ old('parent_phone') }}">
</div>

{{-- Email (opsional) --}}
<div class="mb-4">
    <label for="parent_email" class="block text-sm font-semibold text-gray-700 mb-1">Email Orang Tua/Wali (opsional)</label>
    <input type="email" name="parent_email" id="parent_email"
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: ayah@email.com" value="{{ old('parent_email') }}">
</div>

{{-- Pekerjaan --}}
<div class="mb-4">
    <label for="parent_occupation" class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan Orang Tua/Wali</label>
    <input type="text" name="parent_occupation" id="parent_occupation"
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Petani" value="{{ old('parent_occupation') }}">
</div>

{{-- Alamat Lengkap --}}
<div class="mb-4">
    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
    <textarea name="address" id="address" rows="3" required
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel">{{ old('address') }}</textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Provinsi --}}
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select name="province" id="province" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Provinsi</option>
        </select>
        @error('province')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kabupaten/Kota --}}
    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota</label>
        <select name="city" id="city" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kecamatan --}}
<div class="mt-4 md:mt-0">
    <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
    <select name="district" id="district" required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Kecamatan</option>
    </select>
    @error('district')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Kelurahan --}}
<div class="mt-4 md:mt-0">
    <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa</label>
    <select name="village" id="village" required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Kelurahan/Desa</option>
    </select>
    @error('village')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

</div>

