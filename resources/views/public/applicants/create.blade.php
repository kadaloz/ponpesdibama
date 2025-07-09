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
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    let currentStep = 1;
    const totalSteps = 3;

    function showStep(step) {
        for (let i = 1; i <= totalSteps; i++) {
            document.getElementById('step-' + i)?.classList.add('hidden');
        }
        document.getElementById('step-' + step)?.classList.remove('hidden');

        document.getElementById('prevBtn')?.classList.toggle('hidden', step === 1);
        document.getElementById('nextBtn')?.classList.toggle('hidden', step === totalSteps);
        document.getElementById('submitBtn')?.classList.toggle('hidden', step !== totalSteps);

        if (step === 3) toggleHalaqohPeriod();
    }

    function toggleHalaqohPeriod() {
        const asramaRadio = document.querySelector('input[name="ppdb_type"][value="Asrama"]');
        const group = document.getElementById('halaqoh-period-group');
        if (asramaRadio && group) group.classList.toggle('hidden', asramaRadio.checked);
    }

    function validateInput(input) {
        const name = input.getAttribute('name');
        const value = input.value.trim();
        if (!value) return false;

        if (name === 'parent_email') {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }

        if (name === 'parent_phone') {
            return /^\+?[0-9]{10,15}$/.test(value);
        }

        if (name === 'nisn') {
            return /^[0-9]{10}$/.test(value);
        }

        return true;
    }

    function nextPrev(n) {
        const currentStepDiv = document.getElementById('step-' + currentStep);
        const requiredFields = currentStepDiv.querySelectorAll('[required]');
        let allValid = true;

        requiredFields.forEach(field => {
            const isValid = validateInput(field);
            field.classList.toggle('border-red-500', !isValid);
            if (!isValid) allValid = false;
        });

        if (!allValid && n === 1) {
            alert('Mohon lengkapi dan isi dengan benar semua data yang wajib diisi.');
            return;
        }

        currentStep = Math.max(1, Math.min(totalSteps, currentStep + n));
        showStep(currentStep);
    }

    // Lokasi dinamis
    function setupLocationDropdowns() {
        const provinsiSelect = document.getElementById('province');
        const kabupatenSelect = document.getElementById('city');
        const kecamatanSelect = document.getElementById('district');
        const kelurahanSelect = document.getElementById('village');

        const selectedProv = "{{ old('province', $applicant->province ?? '') }}";
        const selectedKab = "{{ old('city', $applicant->city ?? '') }}";
        const selectedKec = "{{ old('district', $applicant->district ?? '') }}";
        const selectedKel = "{{ old('village', $applicant->village ?? '') }}";

        fetch('/api/provinces')
            .then(res => res.json())
            .then(provinces => {
                provinces.forEach(prov => {
                    provinsiSelect?.appendChild(new Option(prov, prov, false, prov === selectedProv));
                });
                if (selectedProv) {
                    updateCities(selectedProv, selectedKab, selectedKec, selectedKel);
                }
            })
            .catch(err => {
                console.error('❌ Error memuat provinsi:', err);
                alert('❌ Gagal memuat data provinsi.');
            });

        provinsiSelect?.addEventListener('change', function () {
            updateCities(this.value);
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        });

        kabupatenSelect?.addEventListener('change', function () {
            updateDistricts(provinsiSelect.value, this.value);
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        });

        kecamatanSelect?.addEventListener('change', function () {
            updateVillages(provinsiSelect.value, kabupatenSelect.value, this.value);
        });

        function updateCities(provinsi, prefillKab = null, prefillKec = null, prefillKel = null) {
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
                .then(res => res.json())
                .then(cities => {
                    cities.forEach(kab => {
                        kabupatenSelect.appendChild(new Option(kab, kab, false, kab === prefillKab));
                    });
                    if (prefillKab) {
                        updateDistricts(provinsi, prefillKab, prefillKec, prefillKel);
                    }
                })
                .catch(err => {
                    console.error('❌ Error memuat kota/kabupaten:', err);
                    alert('❌ Gagal memuat data kota/kabupaten.');
                });
        }

        function updateDistricts(provinsi, kota, prefillKec = null, prefillKel = null) {
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
                .then(res => res.json())
                .then(districts => {
                    districts.forEach(kec => {
                        kecamatanSelect.appendChild(new Option(kec, kec, false, kec === prefillKec));
                    });
                    if (prefillKec) {
                        updateVillages(provinsi, kota, prefillKec, prefillKel);
                    }
                })
                .catch(err => {
                    console.error('❌ Error memuat kecamatan:', err);
                    alert('❌ Gagal memuat data kecamatan.');
                });
        }

        function updateVillages(provinsi, kota, kecamatan, prefillKel = null) {
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            fetch(`/api/villages?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(kecamatan)}`)
                .then(res => res.json())
                .then(villages => {
                    villages.forEach(kel => {
                        kelurahanSelect.appendChild(new Option(kel, kel, false, kel === prefillKel));
                    });
                })
                .catch(err => {
                    console.error('❌ Error memuat kelurahan:', err);
                    alert('❌ Gagal memuat data kelurahan.');
                });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        showStep(currentStep);
        toggleHalaqohPeriod();
        setupLocationDropdowns();

        const form = document.getElementById('ppdbForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                grecaptcha.ready(function () {
                    grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", { action: 'ppdb_form' })
                        .then(function (token) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'g-recaptcha-response';
                            input.value = token;
                            form.appendChild(input);
                            form.submit();
                        });
                });
            });
        }
    });
</script>
@endpush
@endsection
