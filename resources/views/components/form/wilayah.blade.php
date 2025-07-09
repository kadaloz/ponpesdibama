@props([
    'province' => '',
    'city' => '',
    'district' => '',
    'village' => '',
])

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select
            id="province"
            name="province"
            required
            data-selected="{{ $province }}"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">⏳ Memuat Provinsi...</option>
        </select>
        @error('province')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota</label>
        <select
            id="city"
            name="city"
            required
            data-selected="{{ $city }}"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        @error('city')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
        <select
            id="district"
            name="district"
            required
            data-selected="{{ $district }}"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Kecamatan</option>
        </select>
        @error('district')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa</label>
        <select
            id="village"
            name="village"
            required
            data-selected="{{ $village }}"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Kelurahan/Desa</option>
        </select>
        @error('village')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
