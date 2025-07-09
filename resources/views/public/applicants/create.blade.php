{{-- resources/views/public/applicants/create.blade.php --}}
@extends('web.apps')

@section('title', 'Pendaftaran PPDB Online - PonpesDIBAMA')

@section('main_content')
<section id="ppdb-form" class="py-16 md:py-24 bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-teal-700 drop-shadow-sm">Formulir Pendaftaran PPDB Online</h2>
            <p class="text-lg mt-2 text-gray-600 max-w-2xl mx-auto">
                Isi data diri calon santri dan wali, serta unggah dokumen yang diperlukan.
            </p>
        </div>
        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl max-w-4xl mx-auto">
            @includeIf('components.ppdb.requirements')

            {{-- Formulir Pendaftaran --}}
            <form id="ppdbForm" action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-left" autocomplete="off">
                @csrf

                {{-- Step 1: Calon Santri --}}
                <div class="step" id="step-1">
                    @include('components.ppdb.step1')
                </div>

                {{-- Step 2: Orang Tua & Alamat --}}
                <div class="step hidden" id="step-2">
                    @include('components.ppdb.step2')
                </div>

                {{-- Step 3: Program & Dokumen --}}
                <div class="step hidden" id="step-3">
                    @include('components.ppdb.step3', ['programs' => $programs])
                </div>

                {{-- Navigasi --}}
                <div class="flex justify-between mt-6">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="hidden px-6 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition">Kembali</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)" class="px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition">Lanjut</button>
                    <button type="submit" id="submitBtn" class="hidden px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Kirim Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('province');
    const kabupatenSelect = document.getElementById('city');
    const kecamatanSelect = document.getElementById('district');
    const kelurahanSelect = document.getElementById('village');

    const selectedProv = @json(old('province', $applicant->province ?? ''));
    const selectedKab = @json(old('city', $applicant->city ?? ''));
    const selectedKec = @json(old('district', $applicant->district ?? ''));
    const selectedKel = @json(old('village', $applicant->village ?? ''));

    // Load provinsi awal
    fetch('/api/provinces')
        .then(res => res.json())
        .then(provinces => {
            provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(prov => {
                const option = new Option(prov, prov, false, prov === selectedProv);
                provinsiSelect.appendChild(option);
            });
            if (selectedProv) updateCities(selectedProv);
        });

    provinsiSelect.addEventListener('change', function () {
        updateCities(this.value);
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kabupatenSelect.addEventListener('change', function () {
        updateDistricts(provinsiSelect.value, this.value);
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kecamatanSelect.addEventListener('change', function () {
        updateVillages(provinsiSelect.value, kabupatenSelect.value, this.value);
    });

    function updateCities(provinsi) {
        kabupatenSelect.innerHTML = '<option value="">Memuat...</option>';
        fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
            .then(res => res.json())
            .then(cities => {
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                cities.forEach(kab => {
                    const option = new Option(kab, kab, false, kab === selectedKab);
                    kabupatenSelect.appendChild(option);
                });
                if (selectedKab) updateDistricts(provinsi, selectedKab);
            });
    }

    function updateDistricts(provinsi, kota) {
        kecamatanSelect.innerHTML = '<option value="">Memuat...</option>';
        fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
            .then(res => res.json())
            .then(districts => {
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                districts.forEach(kec => {
                    const option = new Option(kec, kec, false, kec === selectedKec);
                    kecamatanSelect.appendChild(option);
                });
                if (selectedKec) updateVillages(provinsi, kota, selectedKec);
            });
    }

    function updateVillages(provinsi, kota, kecamatan) {
        kelurahanSelect.innerHTML = '<option value="">Memuat...</option>';
        fetch(`/api/villages?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(kecamatan)}`)
            .then(res => res.json())
            .then(villages => {
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                villages.forEach(kel => {
                    const option = new Option(kel, kel, false, kel === selectedKel);
                    kelurahanSelect.appendChild(option);
                });
            });
    }
});
</script>
@endpush

@endsection
