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
document.addEventListener('DOMContentLoaded', function () {
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
        if (asramaRadio && group) {
            group.classList.toggle('hidden', asramaRadio.checked);
        }
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
})   

</script>
@endpush
@endsection
