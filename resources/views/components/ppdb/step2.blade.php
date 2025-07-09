<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Orang Tua & Alamat</h3>

{{-- Nama Orang Tua --}}
<div class="mb-4">
    <label for="parent_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Orang Tua/Wali</label>
    <input type="text" name="parent_name" id="parent_name" required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: H. Abdul Hakim" value="{{ old('parent_name') }}">
    @error('parent_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- No HP --}}
<div class="mb-4">
    <label for="parent_phone" class="block text-sm font-semibold text-gray-700 mb-1">No. HP Orang Tua/Wali</label>
    <input type="text" name="parent_phone" id="parent_phone" required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: 081234567890" value="{{ old('parent_phone') }}">
    @error('parent_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Email --}}
<div class="mb-4">
    <label for="parent_email" class="block text-sm font-semibold text-gray-700 mb-1">Email Orang Tua/Wali (opsional)</label>
    <input type="email" name="parent_email" id="parent_email"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: ayah@email.com" value="{{ old('parent_email') }}">
    @error('parent_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Pekerjaan --}}
<div class="mb-4">
    <label for="parent_occupation" class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan Orang Tua/Wali</label>
    <input type="text" name="parent_occupation" id="parent_occupation"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Petani" value="{{ old('parent_occupation') }}">
    @error('parent_occupation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Alamat --}}
<div class="mb-4">
    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
    <textarea name="address" id="address" rows="3" required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel">{{ old('address') }}</textarea>
    @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Wilayah - Alpine --}}
<div x-data="wilayahDropdown()" x-init="init()" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Provinsi --}}
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select x-model="province" @change="loadCities()" id="province" name="province"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
            <option value="">Pilih Provinsi</option>
            <template x-for="prov in provinces" :key="prov">
                <option :value="prov" x-text="prov"></option>
            </template>
        </select>
        @error('province')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kabupaten --}}
    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota</label>
        <select x-model="city" @change="loadDistricts()" id="city" name="city"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
            <option value="">Pilih Kabupaten/Kota</option>
            <template x-for="kab in cities" :key="kab">
                <option :value="kab" x-text="kab"></option>
            </template>
        </select>
        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kecamatan --}}
    <div>
        <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
        <select x-model="district" @change="loadVillages()" id="district" name="district"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
            <option value="">Pilih Kecamatan</option>
            <template x-for="kec in districts" :key="kec">
                <option :value="kec" x-text="kec"></option>
            </template>
        </select>
        @error('district')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kelurahan --}}
    <div>
        <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa</label>
        <select x-model="village" id="village" name="village"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
            <option value="">Pilih Kelurahan/Desa</option>
            <template x-for="kel in villages" :key="kel">
                <option :value="kel" x-text="kel"></option>
            </template>
        </select>
        @error('village')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

@push('scripts')
<script>
function wilayahDropdown() {
    return {
        provinces: [],
        cities: [],
        districts: [],
        villages: [],
        province: @json(old('province', $applicant->province ?? '')),
        city: @json(old('city', $applicant->city ?? '')),
        district: @json(old('district', $applicant->district ?? '')),
        village: @json(old('village', $applicant->village ?? '')),

        init() {
            fetch('/api/provinces')
                .then(res => res.json())
                .then(data => {
                    this.provinces = data;
                    if (this.province) this.loadCities();
                });
        },

        loadCities() {
            this.cities = [];
            this.districts = [];
            this.villages = [];
            this.city = '';
            this.district = '';
            this.village = '';

            if (!this.province) return;
            fetch(`/api/cities?province=${encodeURIComponent(this.province)}`)
                .then(res => res.json())
                .then(data => {
                    this.cities = data;
                    if (this.city) this.loadDistricts();
                });
        },

        loadDistricts() {
            this.districts = [];
            this.villages = [];
            this.district = '';
            this.village = '';

            if (!this.province || !this.city) return;
            fetch(`/api/districts?province=${encodeURIComponent(this.province)}&city=${encodeURIComponent(this.city)}`)
                .then(res => res.json())
                .then(data => {
                    this.districts = data;
                    if (this.district) this.loadVillages();
                });
        },

        loadVillages() {
            this.villages = [];
            this.village = '';

            if (!this.province || !this.city || !this.district) return;
            fetch(`/api/villages?province=${encodeURIComponent(this.province)}&city=${encodeURIComponent(this.city)}&district=${encodeURIComponent(this.district)}`)
                .then(res => res.json())
                .then(data => {
                    this.villages = data;
                });
        },
    };
}
</script>
@endpush
