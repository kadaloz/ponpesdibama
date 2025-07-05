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
            document.getElementById('step-' + i).classList.add('hidden');
        }
        document.getElementById('step-' + step).classList.remove('hidden');

        document.getElementById('prevBtn').classList.toggle('hidden', step === 1);
        document.getElementById('nextBtn').classList.toggle('hidden', step === totalSteps);
        document.getElementById('submitBtn').classList.toggle('hidden', step !== totalSteps);
          if (step === 3) {
        toggleHalaqohPeriod();
    }
    }
    function toggleHalaqohPeriod() {
        const asramaRadio = document.querySelector('input[name="ppdb_type"][value="Asrama"]');
        const group = document.getElementById('halaqoh-period-group');

        if (asramaRadio.checked) {
            group.classList.add('hidden');
        } else {
            group.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleHalaqohPeriod(); // Jalankan saat halaman pertama kali dimuat
    });

    function validateInput(input) {
        const name = input.getAttribute('name');
        const value = input.value;

        if (!value.trim()) return false;

        if (name === 'parent_email' && value !== '') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(value);
        }

        if (name === 'parent_phone') {
            const phoneRegex = /^\+?[0-9]{10,15}$/;
            return phoneRegex.test(value);
        }

        if (name === 'nisn' && value !== '') {
            const nisnRegex = /^[0-9]{10}$/;
            return nisnRegex.test(value);
        }

        return true;
    }

    function nextPrev(n) {
        const currentStepDiv = document.getElementById('step-' + currentStep);
        const requiredFields = currentStepDiv.querySelectorAll('[required]');
        let allValid = true;

        requiredFields.forEach(field => {
            const isValid = validateInput(field);
            if (!isValid) {
                allValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!allValid && n === 1) {
            alert('Mohon lengkapi dan isi dengan benar semua data yang wajib diisi.');
            return;
        }

        currentStep += n;
        if (currentStep < 1) currentStep = 1;
        if (currentStep > totalSteps) currentStep = totalSteps;
        showStep(currentStep);
    }

    document.addEventListener('DOMContentLoaded', function () {
        showStep(currentStep);

        // Google reCAPTCHA v3 bind
        const form = document.getElementById('ppdbForm');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            grecaptcha.ready(function () {
                grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {action: 'ppdb_form'}).then(function (token) {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', 'g-recaptcha-response');
                    input.setAttribute('value', token);
                    form.appendChild(input);
                    form.submit();
                });
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('province');
    const kabupatenSelect = document.getElementById('city');

    const selectedProv = "{{ old('province', $applicant->province ?? '') }}";
    const selectedKab = "{{ old('city', $applicant->city ?? '') }}";

    // 1. Load provinsi
    fetch('/api/provinces')
        .then(res => res.json())
        .then(provinces => {
            provinces.forEach(prov => {
                const option = new Option(prov, prov, false, prov === selectedProv);
                provinsiSelect.appendChild(option);
            });

            if (selectedProv) {
                updateCities(selectedProv);
            }
        });

    // 2. Jika provinsi berubah, load kabupaten
    provinsiSelect.addEventListener('change', function () {
        updateCities(this.value);
    });

    // 3. Fungsi update kabupaten
    function updateCities(provinsi) {
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';

        fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
            .then(res => res.json())
            .then(cities => {
                cities.forEach(kab => {
                    const option = new Option(kab, kab, false, kab === selectedKab);
                    kabupatenSelect.appendChild(option);
                });
            });
    }
});
</script>
@endpush
@endsection
