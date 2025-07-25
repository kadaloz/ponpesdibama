@props([
    'province' => '',
    'city' => '',
    'district' => '',
    'village' => '',
])

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    {{-- PROVINSI --}}
    <div class="relative">
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select
            id="province"
            name="province"
            required
            data-selected="{{ $province }}"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Provinsi...</option>
        </select>
        <div id="province-loading" class="absolute top-10 right-3 hidden">
            <svg class="animate-spin h-5 w-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
        @error('province')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- KOTA --}}
    <div class="relative">
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
        <div id="city-loading" class="absolute top-10 right-3 hidden">
            <svg class="animate-spin h-5 w-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- KECAMATAN --}}
    <div class="relative">
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
        <div id="district-loading" class="absolute top-10 right-3 hidden">
            <svg class="animate-spin h-5 w-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
        @error('district')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- KELURAHAN --}}
    <div class="relative">
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
        <div id="village-loading" class="absolute top-10 right-3 hidden">
            <svg class="animate-spin h-5 w-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
        @error('village')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>
